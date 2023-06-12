<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('layouts.guest');
        }

        if (!auth()->user()->hasRequiredData()) {
            return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Your account is being limited. Please complete your profile to continue.'
            ]);
        }

        return view('dashboard', [
            'doctor' => Doctor::all()->count(),
            'patient' => Patient::all()->count()
        ]);
    }
}
