<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TransactionController;
use App\Models\Doctor;
use App\Models\Patient;
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
            'doctor' => Doctor::all()->count(),
            'patient' => Patient::all()->count()
        ])
    : view('layouts.guest'))
    ->name('dashboard');


Route::resource('doctors', DoctorController::class);
Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);

/** Payment Callback */
Route::get('transaction/callback', [TransactionController::class, 'callback'])->name('transactions.callback');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
