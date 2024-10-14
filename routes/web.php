<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\TamuController;

// Route default
Route::get('/', function () {
    return redirect()->route('login'); 
});

// Route login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk superadmin
Route::get('/superadminhome', [SuperAdminController::class, 'index'])->name('superadminhome');
Route::get('/datauser', [UserController::class, 'index'])->name('datauser');
Route::get('/datauser/create', [UserController::class, 'create'])->name('datauser.create');
Route::post('/datauser', [UserController::class, 'store'])->name('datauser.store');
Route::delete('/datauser/{id}', [UserController::class, 'destroy'])->name('datauser.destroy');

// Route untuk admin
Route::get('/adminhome', [AdminController::class, 'index'])->name('adminhome');
// event
Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index');
Route::get('/admin/events/create', [EventController::class, 'create'])->name('admin.events.create');
Route::post('/admin/events', [EventController::class, 'store'])->name('admin.events.store');
Route::get('/admin/events/{event}', [EventController::class, 'show'])->name('admin.events.show');
Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit'); 
Route::put('/admin/events/{event}', [EventController::class, 'update'])->name('admin.events.update'); 
Route::delete('/admin/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
// tamu
Route::get('/admin/tamu', [TamuController::class, 'index'])->name('admin.tamu.index');
Route::get('/admin/tamu/{event}', [TamuController::class, 'show'])->name('admin.tamu.show');
Route::get('/admin/tamu/{event}/import', [TamuController::class, 'showImportForm'])->name('admin.tamu.import');
Route::post('/admin/tamu/{event}/import', [TamuController::class, 'import'])->name('admin.tamu.import.post');
Route::get('/admin/tamu/{event}/undangan', [TamuController::class, 'preview'])->name('admin.tamu.preview');
Route::get('admin/tamu/{event}/generate-qrcode', [TamuController::class, 'generateQrCodes'])->name('admin.tamu.generateQrCodes');
Route::get('/admin/tamu/{event}/check', [TamuController::class, 'checkTamu'])->name('admin.tamu.check');

// Route untuk Registrasi
Route::get('/registrasihome', [RegistrasiController::class, 'index'])->name('registrasihome');
Route::get('/api/guest/{qrData}', [TamuController::class, 'getGuestData']);
