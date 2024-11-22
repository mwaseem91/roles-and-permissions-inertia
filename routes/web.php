<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestFormController;


Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('modules', ModuleController::class);
   
});


Route::get('/', [RequestFormController::class, 'create'])->name('request-forms.create');
Route::post('/request-forms/store', [RequestFormController::class, 'store'])->name('request-forms.store');

Route::get('admin/form', function () {
    return Inertia::render('Admin/form');
})->name('form');

require __DIR__.'/auth.php';
