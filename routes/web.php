<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebAdditionController;
use App\Http\Controllers\WebDeviceController;
use App\Http\Controllers\WebPerusahaanController;
use App\Http\Controllers\WebRolesController;
use App\Http\Controllers\WebSettingHargaController;
use App\Http\Controllers\WebSettingRolesController;
use App\Http\Controllers\WebTrxBookingController;
use App\Http\Controllers\WebTrxCuciAddController;
use App\Http\Controllers\WebTrxCuciRealController;
use App\Http\Controllers\WebTypeCuciController;
use App\Http\Controllers\WebUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('tes');

// Auth
Route::get('logout', [WebPerusahaanController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.proses');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Table Perusahaan
// Index
Route::get('/table', [WebPerusahaanController::class, 'index'])->name('table');
// Add
Route::get('/perusahaan/create', [WebPerusahaanController::class, 'create'])->name('create');
Route::post('/perusahaan/store', [WebPerusahaanController::class, 'store'])->name('store');
// Edit
Route::get('/perusahaan/{id}/edit', [WebPerusahaanController::class, 'edit'])->name('edit');
Route::patch('/perusahaan/{id}/update', [WebPerusahaanController::class, 'update'])->name('update');
// Delete
Route::delete('/perusahaan/{id}/delete', [WebPerusahaanController::class, 'destroy'])->name('destroy');


// Table Device
// Index
Route::get('/device', [WebDeviceController::class, 'index'])->name('device');
// Add
Route::get('/device/create', [WebDeviceController::class, 'create'])->name('createdevice');
Route::post('/device/store', [WebDeviceController::class, 'store'])->name('storedevice');
// Edit
Route::get('/device/{id}/edit', [WebDeviceController::class, 'edit'])->name('editdevice');
Route::patch('/device/{id}/update', [WebDeviceController::class, 'update'])->name('updatedevice');
// Delete
Route::delete('/device/{id}/delete', [WebDeviceController::class, 'destroy'])->name('destroydevice');

// Table Type Cuci
// Index
Route::get('/typecuci', [WebTypeCuciController::class, 'index'])->name('typecuci');
// Add
Route::get('/typecuci/createtypecuci', [WebTypeCuciController::class, 'create'])->name('createtypecuci');
Route::post('/typecuci/storetypecuci', [WebTypeCuciController::class, 'store'])->name('storetypecuci');
// Edit
Route::get('/typecuci/{id}/edit', [WebTypeCuciController::class, 'edit'])->name('edittypecuci');
Route::patch('/typecuci/{id}/update', [WebTypeCuciController::class, 'update'])->name('updatetypecuci');
// Delete
Route::delete('/typecuci/{id}/delete', [WebTypeCuciController::class, 'destroy'])->name('destroytypecuci');

// Table Addition
// Index
Route::get('/addition', [WebAdditionController::class, 'index'])->name('addition');
// Add
Route::get('/addition/createaddition', [WebAdditionController::class, 'create'])->name('createaddition');
Route::post('/addition/storeaddition', [WebAdditionController::class, 'store'])->name('storeaddition');
// Edit
Route::get('/addition/{id}/edit', [WebAdditionController::class, 'edit'])->name('editaddition');
Route::patch('/addition/{id}/update', [WebAdditionController::class, 'update'])->name('updateaddition');
// Delete
Route::delete('/addition/{id}/delete', [WebAdditionController::class, 'destroy'])->name('destroyaddition');

// Table Roles
// Index
Route::get('/role', [WebRolesController::class, 'index'])->name('role');
// Add
Route::get('/role/createrole', [WebRolesController::class, 'create'])->name('createrole');
Route::post('/role/storerole', [WebRolesController::class, 'store'])->name('storerole');
// Edit
Route::get('/role/{id}/edit', [WebRolesController::class, 'edit'])->name('editrole');
Route::patch('/role/{id}/update', [WebRolesController::class, 'update'])->name('updaterole');
// Delete
Route::delete('/role/{id}/delete', [WebRolesController::class, 'destroy'])->name('destroyrole');

// Table Setting Roles
// Index
Route::get('/settingroles', [WebSettingRolesController::class, 'index'])->name('settingroles');
// Add
Route::get('/settingroles/createsettingroles', [WebSettingRolesController::class, 'create'])->name('createsettingroles');
Route::post('/settingroles/storesettingroles', [WebSettingRolesController::class, 'store'])->name('storesettingroles');
// Edit
Route::get('/settingroles/{id}/edit', [WebSettingRolesController::class, 'edit'])->name('editsettingroles');
Route::patch('/settingroles/{id}/update', [WebSettingRolesController::class, 'update'])->name('updatesettingroles');
// Delete
Route::delete('/settingroles/{id}/delete', [WebSettingRolesController::class, 'destroy'])->name('destroysettingroles');

// Table User
// Index
Route::get('/user', [WebUserController::class, 'index'])->name('user');
// Add
Route::get('/user/createuser', [WebUserController::class, 'create'])->name('createuser');
Route::post('/user/storeuser', [WebUserController::class, 'store'])->name('storeuser');
// Edit
Route::get('/user/{id}/edit', [WebUserController::class, 'edit'])->name('edituser');
Route::patch('/user/{id}/update', [WebUserController::class, 'update'])->name('updateuser');
// Delete
Route::delete('/user/{id}/delete', [WebUserController::class, 'destroy'])->name('destroyuser');

// Setting Harga
// Index
Route::get('/settingharga', [WebSettingHargaController::class, 'index'])->name('settingharga');
// Add
Route::get('/settingharga/createsettingharga', [WebSettingHargaController::class, 'create'])->name('createsettingharga');
Route::post('/settingharga/storesettingharga', [WebSettingHargaController::class, 'store'])->name('storesettingharga');
// Edit
Route::get('/settingharga/{id}/edit', [WebSettingHargaController::class, 'edit'])->name('editsettingharga');
Route::patch('/settingharga/{id}/update', [WebSettingHargaController::class, 'update'])->name('updatesettingharga');
// Delete
Route::delete('/settingharga/{id}/delete', [WebSettingHargaController::class, 'destroy'])->name('destroysettingharga');

// Transaksi Cuci Booking
// Index
Route::get('/trxbooking', [WebTrxBookingController::class, 'index'])->name('trxbooking');
// Edit
Route::get('/trxbooking/{id}/edit', [WebTrxBookingController::class, 'edit'])->name('edittrxbooking');
Route::patch('/trxbooking/{id}/update', [WebTrxBookingController::class, 'update'])->name('updatetrxbooking');
// Delete
Route::delete('/trxbooking/{id}/delete', [WebTrxBookingController::class, 'destroy'])->name('destroytrxbooking');

// Transaksi Cuci Additional
// Index
Route::get('/trxcuciadd', [WebTrxCuciAddController::class, 'index'])->name('trxcuciadd');
// Edit
Route::get('/trxcuciadd/{id}/edit', [WebTrxCuciAddController::class, 'edit'])->name('edittrxcuciadd');
Route::patch('/trxcuciadd/{id}/update', [WebTrxCuciAddController::class, 'update'])->name('updatetrxcuciadd');
// Delete
Route::delete('/trxcuciadd/{id}/delete', [WebTrxCuciAddController::class, 'destroy'])->name('destroytrxcuciadd');

// Transaksi Cuci Real
// Index
Route::get('/trxcucireal', [WebTrxCuciRealController::class, 'index'])->name('trxcucireal');
// Edit
Route::get('/trxcucireal/{id}/edit', [WebTrxCuciRealController::class, 'edit'])->name('edittrxcucireal');
Route::patch('/trxcucireal/{id}/update', [WebTrxCuciRealController::class, 'update'])->name('updatetrxcucireal');
// Delete
Route::delete('/trxcucireal/{id}/delete', [WebTrxCuciRealController::class, 'destroy'])->name('destroytrxcucireal');







Route::get('/register', function () {
    return view('auth.register');
})->name('register');



