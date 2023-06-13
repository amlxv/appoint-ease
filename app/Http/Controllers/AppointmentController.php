<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user->hasRequiredData()) {
            return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Your account is being limited. Please complete your profile to continue.'
            ]);
        }

        if ($user->isPatient()) {

            if ($request->get('search')) {
                $appointments = Appointment::query()
                    ->where('patient_id', $user->patient->id)
                    ->where(fn(Builder $query) => $query
                        ->where('id', 'like', '%' . $request->get('search') . '%')
                        ->orWhere('case', 'like', '%' . $request->get('search') . '%'))
                    ->latest()
                    ->simplePaginate(10)
                    ->withQueryString();

                return view('patient.appointment.index', ['appointments' => $appointments]);
            }

            $appointments = Appointment::query()
                ->where('patient_id', $user->patient->id)
                ->orderBy('id', 'desc')
                ->simplePaginate(10);
            return view('patient.appointment.index', [
                'appointments' => $appointments
            ]);
        }

        if ($user->isDoctor()) {

            if ($request->get('search')) {
                $appointments = Appointment::query()
                    ->where('doctor_id', $user->doctor->id)
                    ->where(fn(Builder $query) => $query
                        ->where('id', 'like', '%' . $request->get('search') . '%')
                        ->orWhere('case', 'like', '%' . $request->get('search') . '%'))
                    ->latest()
                    ->simplePaginate(10)
                    ->withQueryString();

                return view('doctor.appointment.index', ['appointments' => $appointments]);
            }

            $appointments = Appointment::query()
                ->where('doctor_id', $user->doctor->id)
                ->orderBy('id', 'desc')
                ->simplePaginate(10);
            return view('doctor.appointment.index', [
                'appointments' => $appointments
            ]);
        }

        if ($user->isAdmin()) {

            if ($request->get('search')) {
                $appointments = Appointment::query()
                    ->where('id', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('case', 'like', '%' . $request->get('search') . '%')
                    ->latest()
                    ->simplePaginate(10)
                    ->withQueryString();

                return view('admin.appointment.index', ['appointments' => $appointments]);
            }

            $appointments = Appointment::query()
                ->latest()
                ->simplePaginate(10);
            return view('admin.appointment.index', [
                'appointments' => $appointments
            ]);
        }

        return redirect()->back()->with([
            'status' => 'error',
            'message' => 'There is an error when processing your request. Please try again later.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isPatient()) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not a patient'
            ]);
        }

        $doctors = Appointment::query()
            ->where('date',)
            ->where('status', '!=', 'completed')
            ->pluck('doctor_id');

        $doctors = Doctor::query()->whereNotIn('id', $doctors)->get();

        $formData = [
            'doctors' => $doctors
        ];

        return view('patient.appointment.create', [
            "formData" => $formData
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isPatient()) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not a patient'
            ]);
        }

        $request->validate([
            'doctor' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $date = Carbon::parse($request->get('date'));
        $now = Carbon::now();

        if ($date->lessThan($now)) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You cannot book an appointment in the past'
            ])->withInput();
        }

        if ($date->diffInDays($now) < 7) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You can only book an appointment after 7 days'
            ])->withInput();
        }

        $appointment = Appointment::query()->create([
            'case' => $request->get('case'),
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'doctor_id' => $request->get('doctor'),
            'patient_id' => auth()->user()->patient->id,
        ]);

        if (!$appointment) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to create appointment'
            ]);
        }

        return $this->handlePayment($appointment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * UseCase: Only for doctor to update appointment status and MC
     */
    public function edit(Appointment $appointment)
    {
        if (!auth()->user()->isDoctor()) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not a doctor'
            ]);
        }

        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not the doctor of this appointment'
            ]);
        }

        if ($appointment->status != 'pending') {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You cannot update this appointment'
            ]);
        }

        return view('doctor.appointment.edit', [
            'formData' => $appointment->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::query()->find($id);

        if (!auth()->user()->isDoctor()) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not a doctor'
            ]);
        }

        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You are not the doctor of this appointment'
            ]);
        }

        if ($appointment->status != 'pending') {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'You cannot update this appointment'
            ]);
        }

        $request->validate([
            'medical_certificate' => 'nullable|numeric',
        ]);

        $appointment->medical_certificate = $request->get('medical_certificate');
        $appointment->status = 'completed';

        if (!$appointment->save()) {
            return redirect()->route('appointments.edit')->with([
                'status' => 'error',
                'message' => 'Failed to update appointment'
            ]);
        }

        return redirect()->route('appointments.index')->with([
            'status' => 'success',
            'message' => 'Appointment updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function handlePayment($appointmentId)
    {
        $transaction = new TransactionController(auth()->user()->patient->id, $appointmentId);
        $result = $transaction->create();

        if (!$result->patient) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to create transaction'
            ]);
        }

        $result = $transaction->createPayment();

        if (!$result) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to create payment'
            ]);
        }

        return redirect()->away($result);
    }
}
