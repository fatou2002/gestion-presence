<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Importation directe des middlewares
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\ManagerMiddleware;

Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard');

    // Routes accessibles aux admins uniquement
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class);

    });

    // Routes accessibles aux gestionnaires uniquement
    Route::middleware([ManagerMiddleware::class])->group(function () {
        Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
        Route::resource('services', ServiceController::class);
        Route::resource('creneaux', CreneauController::class);
        Route::get('/presences/recap', [PresenceController::class, 'recap'])->name('presences.recap');
        Route::get('/export/pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
        Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/statistiques', [App\Http\Controllers\PresenceController::class, 'statistiques'])->name('statistiques');

    });

    // Routes accessibles aux employés uniquement
    Route::middleware([EmployeeMiddleware::class])->group(function () {
        Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        Route::resource('presences', PresenceController::class);
        Route::post('/presences/{id}/emarger', [PresenceController::class, 'emarger'])->name('presences.emarger'); // 👈 ICI
        Route::get('/check-in', [PresenceController::class, 'checkInForm'])->name('presences.checkin');
        Route::post('/check-in', [PresenceController::class, 'checkIn'])->name('presences.checkin.store');
    });


});
