<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/**
 * Guest Page & Dashboard
 *
 */
Route::get('/', fn() => Auth::check()
    ? view('dashboard',
        [
            'doctor' => \App\Models\Doctor::all()->count(),
            'patient' => \App\Models\Patient::all()->count()
        ])
    : view('layouts.guest'))
    ->name('dashboard');


/**
 * Admin Page
 *  - doctor
 */
//Route::get('/doctors',
//    "App\Http\Controllers\DoctorController@index")
//    ->name('doctors');
//
//Route::get('/doctors/create',
//    "App\Http\Controllers\DoctorController@create")
//    ->name('doctors.create');
//
//Route::post('/doctors/store',
//    "App\Http\Controllers\DoctorController@store")
//    ->name('doctors.store');
//
//Route::get('/doctors/{id}/edit',
//    "App\Http\Controllers\DoctorController@edit")
//    ->name('doctors.edit');
Route::resource('doctors', DoctorController::class);

/**
 * Admin Page
 * - patient
 */
Route::get('/patients',
    "App\Http\Controllers\PatientController@index")
    ->name('patients');

Route::get('/patients/create',
    "App\Http\Controllers\PatientController@create")
    ->name('patients.create');

Route::get('/patients/{id}/edit',
    "App\Http\Controllers\PatientController@edit")
    ->name('patients.edit');
