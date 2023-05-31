<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::query()->where('role', 'doctor')->latest()->simplePaginate(10);
        $data = [
            'id' => 'doctor.id',
            'users' => $users,
            'route' => 'doctors',
            'columns' => [
                'Name' => '',
                'Specialization' => 'doctor.specialization',
                'Qualification' => 'doctor.qualification',
                'Experience' => 'doctor.experience',
                'Phone Number' => 'phone_number',
                'Status' => 'doctor.status',
                'Action' => '',
            ],
        ];

        return view('admin.doctor.index', ['tableData' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'colspan' => '6'
            ],
            'email' => [
                'label' => 'Email',
                'type' => 'email',
                'colspan' => '6'
            ],
            'password' => [
                'label' => 'Password',
                'type' => 'password',
                'colspan' => '3'
            ],
            'password_confirmation' => [
                'label' => 'Confirm Password',
                'type' => 'password',
                'colspan' => '3'
            ],
            'phone_number' => [
                'label' => 'Phone Number',
                'type' => 'text',
                'colspan' => '6'
            ],
            'address' => [
                'label' => 'Address',
                'type' => 'text',
                'colspan' => '6'
            ],
        ];

        $additionalItems = [
            'specialization' => [
                'label' => 'Specialization',
                'type' => 'text',
                'colspan' => '3'
            ],
            'qualification' => [
                'label' => 'Qualification',
                'type' => 'text',
                'colspan' => '3'
            ],
            'experience' => [
                'label' => 'Experience',
                'type' => 'number',
                'colspan' => '3'
            ],
        ];

        return view('admin.doctor.create', ['items' => $items, 'additionalItems' => $additionalItems]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * Validate the request
         */
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255|min:3',
            'specialization' => 'required|string',
            'qualification' => 'required|string',
            'experience' => 'required|numeric',
        ]);


        $result = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => 'doctor',
        ]);

        if (!$result) abort(500, 'Something went wrong when creating user.');


        $result = Doctor::query()->where('user_id', $result->id)->update(
            [
                'specialization' => $request->specialization,
                'qualification' => $request->qualification,
                'experience' => $request->experience,
            ]
        );

        if (!$result) abort(500, 'Something went wrong when creating doctor.');

        return redirect()->route('doctors')->with('success', 'Doctor created successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
