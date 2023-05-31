<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        $users = User::query()->where('role', 'doctor')->simplePaginate(10);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
