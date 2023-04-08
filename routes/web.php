<?php

use App\Http\Controllers\Admin\AdminKostController;
use App\Http\Controllers\DaftarKostController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return redirect()->route('home');
});


Route::GET('/', [HomeController::class, 'index'])->name('home');
Route::GET('/daftar-kost', [DaftarKostController::class, 'index'])->name('daftar-kost.index');
Route::POST('/daftar-kost', [DaftarKostController::class, 'store'])->name('daftar-kost.store');
Route::GET('/details/{id}', [DetailsController::class, 'index'])->name('details');
Route::POST('/review/create', [ReviewController::class, 'store'])->name('review.store');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('kost', AdminKostController::class);
    Route::POST('/kost/verif', [AdminKostController::class, 'verifikasi'])->name('kost.verif');
});


Auth::routes();
