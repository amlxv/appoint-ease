<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        $users = User::query()->where('role', 'patient')->simplePaginate(10);
        $data = [
            'id' => 'patient.id',
            'users' => $users,
            'route' => 'patients',
            'columns' => [
                'Name' => '',
                'Phone Number' => 'phone_number',
                'Blood Type' => 'patient.blood_type',
                'Gender' => 'patient.gender',
                'Medical Records' => 'patient.medical_records',
                'Allergies' => 'patient.allergies',
                'Action' => '',
            ],
        ];

        return view('admin.patient.index', ['tableData' => $data]);
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
