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
Route::get('/doctor', "App\Http\Controllers\DoctorController@index")
    ->name('doctor')
    ->middleware('auth');
