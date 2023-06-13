<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('layouts.guest');
        }

        $user = auth()->user();

        if (!$user->hasRequiredData()) {
            return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Your account is being limited. Please complete your profile to continue.'
            ]);
        }

        $dataToRedirect = [];

        if ($user->isPatient()) {
            $appointments = Appointment::query()->where('patient_id', $user->patient->id)->get();
            $dataToRedirect = [
                'total_appointment' => $appointments->count(),
                'completed_appointment' => $appointments->where('status', 'completed')->count(),
                'failed_appointment' => $appointments->where('status', 'failed')->count(),
                'pending_appointment' => $appointments->where('status', 'pending')->count(),
                'unpaid_appointment' => $appointments->where('status', 'unpaid')->count(),
            ];
        }

        if ($user->isDoctor()) {
            $appointments = Appointment::query()->where('doctor_id', $user->doctor->id)->get();
            $dataToRedirect = [
                'total_appointment' => $appointments->count(),
                'completed_appointment' => $appointments->where('status', 'completed')->count(),
                'failed_appointment' => $appointments->where('status', 'failed')->count(),
                'pending_appointment' => $appointments->where('status', 'pending')->count(),
            ];
        }

        if ($user->isAdmin()) {
            $dataToRedirect = [
                'total_user' => User::all()->count(),
                'total_doctor' => Doctor::all()->count(),
                'total_patient' => Patient::all()->count(),
                'total_appointment' => Appointment::all()->count(),
                'total_transaction' => Transaction::all()->count()
            ];
        }
        
        return view('dashboard', [...$dataToRedirect]);
    }
}
