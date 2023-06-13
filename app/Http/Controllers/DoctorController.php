<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
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
    public function index(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($request->get('search')) {
            $users = User::query()
                ->where('role', 'doctor')
                ->where(fn(Builder $query) => $query
                    ->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('phone_number', 'like', '%' . $request->get('search') . '%'))
                ->latest()
                ->simplePaginate(10)
                ->withQueryString();

            return view('admin.doctor.index', ['users' => $users]);
        }

        $users = User::query()->where('role', 'doctor')->latest()->simplePaginate(10);

        return view('admin.doctor.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
            'specialization' => 'required|string',
            'qualification' => 'required|string',
            'experience' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number'),
            'address' => $request->get('address'),
            'role' => 'doctor',
        ];

        if ($request->file('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars');
        }

        $result = User::query()->create($data);

        if (!$result) return redirect()->route('doctors.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when creating user.'
        ]);

        $result = Doctor::query()->where('user_id', $result->id)->update(
            [
                'specialization' => $request->get('specialization'),
                'qualification' => $request->get('qualification'),
                'experience' => $request->get('experience'),
            ]
        );

        if (!$result) return redirect()->route('doctors.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when creating doctor.'
        ]);

        return redirect()->route('doctors.index')->with([
            'status' => 'success',
            'message' => 'Doctor created successfully.'
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
    public function edit(Doctor $doctor)
    {
        return view('admin.doctor.edit', ['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
            'specialization' => 'required|string',
            'qualification' => 'required|string',
            'experience' => 'required|numeric',
            'status' => 'required|in:active,inactive',
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

        if ($request->file('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars');
        }

        $result = $doctor->user()->update($data);

        if (!$result) return redirect()->route('doctors.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when updating user.',
        ]);

        $result = $doctor->update(
            [
                'specialization' => $request->get('specialization'),
                'qualification' => $request->get('qualification'),
                'experience' => $request->get('experience'),
                'status' => $request->get('status'),
            ]
        );

        if (!$result) return redirect()->route('doctors.index')->with([
            'status' => 'error',
            'message' => 'Something went wrong when updating doctor.',
        ]);

        return redirect()->route('doctors.index')->with([
            'status' => 'success',
            'message' => 'Doctor updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Doctor $doctor
     */
    public function destroy(Doctor $doctor)
    {
        if (!$doctor->user()->delete())
            return redirect()->route('doctors.index')
                ->with(['status' => 'error', 'message' => 'Something went wrong when deleting user.']);

        return redirect()->route('doctors.index')
            ->with(['status' => 'success', 'message' => 'Doctor deleted successfully.']);
    }
}
