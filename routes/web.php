<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\TamuController;
use App\Exports\TamuExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Event;
use Illuminate\Support\Str;

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
// Event
Route::get('/superadmin/events', [EventController::class, 'supindex'])->name('superadmin.events.index');
Route::get('/superadmin/events/create', [EventController::class, 'supcreate'])->name('superadmin.events.create');
Route::post('/superadmin/events', [EventController::class, 'supstore'])->name('superadmin.events.store');
Route::get('/superadmin/events/{event}', [EventController::class, 'supshow'])->name('superadmin.events.show');
Route::get('/superadmin/events/{event}/edit', [EventController::class, 'supedit'])->name('superadmin.events.edit'); 
Route::put('/superadmin/events/{event}', [EventController::class, 'supupdate'])->name('superadmin.events.update'); 
Route::delete('/superadmin/events/{event}', [EventController::class, 'supdestroy'])->name('superadmin.events.destroy');
// Tamu
Route::get('/superadmin/tamu', [TamuController::class, 'supindex'])->name('superadmin.tamu.index');
Route::get('/superadmin/tamu/{event}', [TamuController::class, 'supshow'])->name('superadmin.tamu.show');
Route::get('/superadmin/tamu/{event}/import', [TamuController::class, 'supshowImportForm'])->name('superadmin.tamu.import');
Route::post('/superadmin/tamu/{event}/import', [TamuController::class, 'supimport'])->name('superadmin.tamu.import.post');
Route::get('/superadmin/tamu/{event}/undangan', [TamuController::class, 'suppreview'])->name('superadmin.tamu.preview');
Route::get('superadmin/tamu/{event}/generate-qrcode', [TamuController::class, 'supgenerateQrCodes'])->name('superadmin.tamu.generateQrCodes');
Route::get('/superadmin/tamu/{event}/check', [TamuController::class, 'supcheckTamu'])->name('superadmin.tamu.check');
Route::get('/superadmin/kehadiran/{eventId}', [TamuController::class, 'supkehadiran'])->name('superadmin.kehadiran');
Route::get('superadmin/tamu/{event}/export', function($eventId) {
    $event = Event::findOrFail($eventId);
    $fileName = 'kehadiran-tamu-' . Str::slug($event->namaevent) . '.xlsx';  
    return Excel::download(new TamuExport($eventId), $fileName);
})->name('supexport.tamu');
Route::put('/superadmin/tamu/{tamu}/unregister', [TamuController::class, 'supunregister'])->name('superadmin.tamu.unregister');

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
Route::get('/admin/kehadiran/{eventId}', [TamuController::class, 'kehadiran'])->name('admin.kehadiran');
Route::get('admin/tamu/{event}/export', function($eventId) {
    $event = Event::findOrFail($eventId);
    $fileName = 'kehadiran-tamu-' . Str::slug($event->namaevent) . '.xlsx';  
    return Excel::download(new TamuExport($eventId), $fileName);
})->name('export.tamu');
Route::put('/admin/tamu/{tamu}/unregister', [TamuController::class, 'unregister'])->name('admin.tamu.unregister');

// Route untuk Registrasi
Route::get('/registrasihome', [RegistrasiController::class, 'index'])->name('registrasihome');
Route::get('/api/guest/{qrData}', [TamuController::class, 'getGuestData']);
