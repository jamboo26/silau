<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/pengaduan', [PengaduanController::class, 'showPengaduan'])
    ->name('pengaduan')
    ->middleware('auth');

Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])
    ->name('pengaduan.show')
    ->middleware('auth');

Route::post('/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatus'])
    ->name('pengaduan.updateStatus')
    ->middleware('auth');

Route::post('/pengaduan/{id}/connect-chat', [PengaduanController::class, 'connectChat'])
    ->name('pengaduan.connectChat')
    ->middleware('auth');

Route::post('/pengaduan/{id}/disconnect-chat', [PengaduanController::class, 'disconnectChat'])
    ->name('pengaduan.disconnectChat')
    ->middleware('auth');

Route::post('/pengaduan/{id}/send-chat', [PengaduanController::class, 'sendChat'])
    ->name('pengaduan.sendChat')
    ->middleware('auth');

Route::post('/pengaduan-print', [PengaduanController::class, 'printPdf'])
    ->name('pengaduan.print');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});
