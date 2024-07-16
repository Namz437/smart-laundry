<?php

use App\Http\Controllers\Api\AdditionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BayarController;
use App\Http\Controllers\Api\BayarProsesController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SettingHargaController;
use App\Http\Controllers\Api\SettingRolesController;
use App\Http\Controllers\Api\TransaksiCucianAddController;
use App\Http\Controllers\Api\TransaksiCucianController;
use App\Http\Controllers\Api\TransaksiCucianRealController;
use App\Http\Controllers\Api\TypeCuciController;
use App\Models\TransaksiCucian;
use App\Models\TransaksiCucianAdd;
use App\Models\TransaksiCucianReal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/search-user', [AuthController::class, 'search']);
});

// Route Middleware Group
Route::group(['middleware' => ['auth:sanctum', 'isAdmin'], 'prefix' => 'admin'], function () {
    // Settings Roles
    Route::resource('settings_roles', SettingRolesController::class);
    // Device Mesin Cuci
    Route::resource('device', DeviceController::class);
    // Roles
    Route::resource('roles', RolesController::class);
    // Perusahaan
    Route::resource('profil_perusahaan', PerusahaanController::class);
    Route::put('perusahaan', [PerusahaanController::class, 'update']);
    // Type cuci
    Route::resource('type_cuci', TypeCuciController::class);
    // Setting Harga
    Route::resource('set_harga', SettingHargaController::class);
    // Addition
    Route::resource('add', AdditionController::class);
    // Transaksi cuci
    Route::resource('transaksi_cuci', TransaksiCucianController::class);
    // Transaksi Cucian Add
    Route::resource('transaksi_cuci_add', TransaksiCucianAddController::class);
    // Transaksi Cucian Real
    Route::resource('transaksi_cuci_real', TransaksiCucianRealController::class);
});

// Untuk User
Route::get('device', [DeviceController::class, 'index']);
Route::get('roles', [RolesController::class, 'index']);
Route::get('profil_perusahaan', [PerusahaanController::class, 'index']);
Route::get('type_cuci', [TypeCuciController::class, 'index']);
Route::get('set_harga', [SettingHargaController::class, 'index']);
Route::get('add', [AdditionController::class, 'index']);

// Route::get('transaksi_cuci', [TransaksiCucianController::class, 'store']);
// Route::get('transaksi_cuci', [TransaksiCucianController::class, 'update']);
// Route::get('transaksi_cuci', [TransaksiCucianController::class, 'delete']);
// Route::get('transaksi_cuci/{id}', [TransaksiCucianController::class, 'show']);

// Route::get('transaksi_cuci_add', [TransaksiCucianAddController::class, 'store']);
// Route::get('transaksi_cuci_add', [TransaksiCucianAddController::class, 'update']);
// Route::get('transaksi_cuci_add', [TransaksiCucianAddController::class, 'delete']);
// Route::get('transaksi_cuci_add', [TransaksiCucianAddController::class, 'show']);

// Cek
// Route::post('process-payment', BayarProsesController::class);
