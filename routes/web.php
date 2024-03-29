<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('index');
    });

    Route::resource('employees', EmployeeController::class);

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances');
    Route::get('/attendances/{employee}', [AttendanceController::class, 'detail'])->name('attendances.detail');

    Route::get('/attendances/{employee}/create', [AttendanceController::class, 'create'])->name('attendances.detail.create');
    Route::post('/attendances/{employee}', [AttendanceController::class, 'store'])->name('attendances.detail.store');

    Route::get('/attendances/{employee}/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendances.detail.edit');
    Route::put('/attendances/{employee}/{attendance}', [AttendanceController::class, 'update'])->name('attendances.detail.update');

    Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.detail.destroy');

    Route::post('/export', [AttendanceController::class, 'export'])->name('export');
});

