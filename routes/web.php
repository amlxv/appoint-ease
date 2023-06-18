<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('doctors', DoctorController::class);
Route::resource('patients', PatientController::class);
Route::resource('appointments', AppointmentController::class);

/** Payment Callback */
Route::get('transaction/callback', [TransactionController::class, 'callback'])->name('transactions.callback');
Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');

/** Profile */
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
