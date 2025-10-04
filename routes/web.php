<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

// Rutas de autenticación
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Módulo de Empleados
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    });
    
    // Módulo de Control Horario
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');
        Route::get('/history', [AttendanceController::class, 'history'])->name('history');
        Route::get('/reports', [AttendanceController::class, 'reports'])->name('reports');
    });
    
    // Portal de Autogestión del Empleado
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [EmployeeController::class, 'profile'])->name('index');
        Route::get('/edit', [EmployeeController::class, 'editProfile'])->name('edit');
        Route::put('/update', [EmployeeController::class, 'updateProfile'])->name('update');
        Route::get('/documents', [EmployeeController::class, 'documents'])->name('documents');
    });
});

