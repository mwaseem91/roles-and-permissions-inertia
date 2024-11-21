<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestFormController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('request-forms', RequestFormController::class);
    Route::post('/request-forms/file-upload', [RequestFormController::class, 'fileUpload']);

});

Route::get('admin/form', function () {
    return Inertia::render('Admin/form');
})->name('form');

require __DIR__.'/auth.php';
