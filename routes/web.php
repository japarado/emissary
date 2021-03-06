<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RejectedContactController;
use App\Http\Controllers\VoucherController;
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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('cards')->group(function () {
        Route::get('import', [CardController::class, 'import'])->name('cards.import');
    });

    Route::resource('cards', CardController::class)->parameter('cards', 'id');

    Route::resource('vouchers', VoucherController::class)->parameter('vouchers', 'id');

    Route::resource('contacts', ContactController::class)->parameter('contacts', 'id');

    Route::resource('rejected-contacts', RejectedContactController::class)->parameter('rejected-contacts', 'id');

	Route::resource('batches', BatchController::class)->parameter('batches', 'id');
});
