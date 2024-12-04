<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestFormController; 

Route::middleware('auth')->prefix('admin')->group(function () { 

    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('modules', ModuleController::class)->except(['show']);
   
    Route::delete('/request-forms/destroy/{id}', [RequestFormController::class, 'destroy'])->name('form-requests.destroy');
    Route::post('/request-forms/change-status', [RequestFormController::class, 'changeStatus'])->name('form-requests.change-status');
    Route::get('/request-forms', [RequestFormController::class, 'index'])->name('request-forms.index');
    Route::get('/request-forms/{id}', [RequestFormController::class, 'show'])->name('request-forms.show');
    Route::get('/request-form/audit', [RequestFormController::class, 'viewAudit'])->name('request-form.audit');
    Route::get('/request-form/assigned/{referralId}', [RequestFormController::class, 'RequestFormAssigned'])->name('request-form.assigned');
    Route::post('/request-form/assigned', [RequestFormController::class, 'RequestFormAssignedSubmit'])->name('form-requests.assigned-to');

   
});

Route::middleware('auth')->group(function () {
    Route::post('/2fa/verify-email', [TwoFactorController::class, 'verifyEmail2faCode']);
});

Route::get('/', [RequestFormController::class, 'create'])->name('request-forms.create');
Route::post('/request-forms/store', [RequestFormController::class, 'store'])->name('request-forms.store');



Route::post('/verification', [TwoFactorController::class, 'verification'])->name('verification.code');


require __DIR__.'/auth.php';
