<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $user = auth()->user();

        if ($user->isPatient()) {
            return view('profile', ['user' => $user->patient]);
        } elseif ($user->isDoctor()) {
            return view('profile', ['user' => $user->doctor]);
        }

        return redirect()->route('dashboard')->with([
            'status' => 'error',
            'message' => 'You are not allowed to access this page'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $shouldValidate = [
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
        ];

        if ($user->isPatient()) {
            $shouldValidate = array_merge($shouldValidate, [
                'medical_records' => 'nullable|string',
                'allergies' => 'nullable|string',
                'blood_type' => 'nullable|in:A,B,AB,O',
                'gender' => 'nullable|in:male,female',
            ]);

            $patient = auth()->user()->patient;
            $request->validate($shouldValidate);

            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
                'address' => $request->get('address'),
            ];

            if ($request->get('password')) {
                $data['password'] = Hash::make($request->get('password'));
            }

            if ($request->file('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars');
            }

            $result = $user->update($data);

            if (!$result) return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Something went wrong when updating user information.',
            ]);

            $result = $patient->update(
                [
                    'medical_records' => $request->get('medical_records'),
                    'allergies' => $request->get('allergies'),
                    'blood_type' => $request->get('blood_type'),
                    'gender' => $request->get('gender'),
                ]
            );

            if (!$result) return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Something went wrong when updating patient information.',
            ]);

            return redirect()->route('dashboard')->with([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
            ]);
        }

        if ($user->isDoctor()) {
            $shouldValidate = array_merge($shouldValidate, [
                'specialization' => 'required|string',
                'qualification' => 'required|string',
                'experience' => 'required|numeric',
                'status' => 'required|in:active,inactive',
            ]);

            $doctor = auth()->user()->doctor;
            $request->validate($shouldValidate);

            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
                'address' => $request->get('address'),
            ];

            if ($request->get('password')) {
                $data['password'] = Hash::make($request->get('password'));
            }

            if ($request->file('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars');
            }

            $result = $user->update($data);

            if (!$result) return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Something went wrong when updating user information.',
            ]);

            $result = $doctor->update(
                [
                    'specialization' => $request->get('specialization'),
                    'qualification' => $request->get('qualification'),
                    'experience' => $request->get('experience'),
                    'status' => $request->get('status'),
                ]
            );

            if (!$result) return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Something went wrong when updating doctor information.',
            ]);

            return redirect()->route('dashboard')->with([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
            ]);
        }

        return redirect()->route('dashboard')->with([
            'status' => 'error',
            'message' => 'Something went wrong!.',
        ]);
    }
}
