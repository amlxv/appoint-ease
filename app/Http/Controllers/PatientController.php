<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Prevent unauthorized access to this controller methods
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::query()->where('role', 'patient')->latest()->simplePaginate(10);

        return view('admin.patient.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
            'medical_records' => 'nullable|string',
            'allergies' => 'nullable|string',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'gender' => 'nullable|in:male,female',
        ]);

        $result = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address'),
            'role' => 'patient',
        ]);

        if (!$result) return redirect()->route('patients.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when creating user.'
        ]);

        $result = Patient::query()->where('user_id', $result->id)->update(
            [
                'medical_records' => $request->get('medical_records'),
                'allergies' => $request->get('allergies'),
                'blood_type' => $request->get('blood_type'),
                'gender' => $request->get('gender'),
            ]
        );

        if (!$result) return redirect()->route('patients.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when creating patient.'
        ]);

        return redirect()->route('patients.index')->with([
            'status' => 'success',
            'message' => 'Patient created successfully.'
        ]);
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
     */
    public function edit(Patient $patient)
    {
        return view('admin.patient.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
            'medical_records' => 'nullable|string',
            'allergies' => 'nullable|string',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'gender' => 'nullable|in:male,female',
        ]);

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address'),
        ];

        if ($request->get('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        $result = $patient->user()->update($data);

        if (!$result) return redirect()->route('patients.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when updating user.',
        ]);

        $result = $patient->update(
            [
                'medical_records' => $request->get('medical_records'),
                'allergies' => $request->get('allergies'),
                'blood_type' => $request->get('blood_type'),
                'gender' => $request->get('gender'),
            ]
        );

        if (!$result) return redirect()->route('patients.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when updating patient.',
        ]);

        return redirect()->route('patients.index')->with([
            'status' => 'success',
            'message' => 'Patient updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        if (!$patient->user()->delete())
            return redirect()->route('patients.index')
                ->with(['status' => 'error', 'message' => 'Something went wrong when deleting user.']);

        return redirect()->route('patients.index')
            ->with(['status' => 'success', 'message' => 'Patient deleted successfully.']);
    }
}
