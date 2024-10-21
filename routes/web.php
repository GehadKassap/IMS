<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SystemLogController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\SystemTrashController;
use App\Http\Controllers\CollegesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\AcademicYearsController;



Route::middleware(['auth', 'can:dashboard'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // System Settings
    // -- College
    Route::resource('colleges', CollegesController::class);

    // -- Departments
    Route::resource('departments', DepartmentsController::class);

    // -- Academic Years 
    Route::resource('academic-years', AcademicYearsController::class);

    Route::resource('users', UsersController::class);

    Route::resource('roles', RolesController::class);

    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');

    Route::get('/system-log', [SystemLogController::class, 'index'])->name('system-log');

    Route::get('/system-trash', [SystemTrashController::class, 'index'])->name('system-trash');


    Route::get('/under-development', function () {
        return Inertia::render('under-development');
    })->name('under-development');
    
});


require __DIR__ . '/auth.php';
