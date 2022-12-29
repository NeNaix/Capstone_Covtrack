<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/authenticate', [App\Http\Controllers\MultiUserLoginController::class, 'login'])->name('authenticate');
Route::get('/logout', [App\Http\Controllers\MultiUserLoginController::class, 'logout'])->name('logout');

Route::get('/account/setting/{id}', [App\Http\Controllers\HospitalController::class, 'setting_admin'])->name('setting_admin');
Route::post('/account/update/{id}', [App\Http\Controllers\HospitalController::class, 'update_admin'])->name('update_admin');

Route::get('/user/barangay/setting/{id}', [App\Http\Controllers\BarangayController::class, 'setting_b'])->name('setting_b');
Route::post('/user/barangay/update/{id}', [App\Http\Controllers\BarangayController::class, 'update_b'])->name('update_b');

Route::get('/user/hospital/setting/{id}', [App\Http\Controllers\HospitalUserController::class, 'setting_h'])->name('setting_h');
Route::post('/user/hospital/update/{id}', [App\Http\Controllers\HospitalUserController::class, 'update_h'])->name('update_h');

Route::get('/user/hospital', [App\Http\Controllers\HospitalUserController::class, 'index'])->name('hospital_user');

Route::get('/user/barangay', [App\Http\Controllers\BarangayController::class, 'index'])->name('barangay_user');


Route::get('/home', [App\Http\Controllers\HospitalController::class, 'index'])->name('home');
Route::get('/report', [App\Http\Controllers\HospitalController::class, 'dwn'])->name('report');
Route::post('/add/user_hospital', [App\Http\Controllers\HospitalController::class, 'user_hospital'])->name('add_uh');

Route::get('/brgy', [App\Http\Controllers\HospitalController::class, 'brgy'])->name('brgy');
Route::get('/covid', [App\Http\Controllers\HospitalController::class, 'covid_main'])->name('covid_main');
Route::get('/stats', [App\Http\Controllers\HospitalController::class, 'stats'])->name('stats');
Route::get('/hospital', [App\Http\Controllers\HospitalController::class, 'data_hospital'])->name('hospital');
Route::get('/new/hospital', [App\Http\Controllers\HospitalController::class, 'new_hospital'])->name('new_hospital');
Route::get('/update/hospital', [App\Http\Controllers\HospitalController::class, 'update_hospital'])->name('update_hospital');

Route::get('/quarantine', [App\Http\Controllers\QuarantineController::class, 'index'])->name('quarantine');
Route::get('/new/quarantine', [App\Http\Controllers\QuarantineController::class, 'new_quarantine'])->name('new_quarantine');
Route::get('/update/quarantine', [App\Http\Controllers\QuarantineController::class, 'update_quarantine'])->name('update_quarantine');

Route::get('/testing', [App\Http\Controllers\TestingController::class, 'index'])->name('testing');
Route::get('/new/testing', [App\Http\Controllers\TestingController::class, 'new_testing'])->name('new_testing');
Route::get('/update/testing', [App\Http\Controllers\TestingController::class, 'update_testing'])->name('update_testing');


URL::forceScheme('https');