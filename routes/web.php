<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RaveController;
use App\Http\Controllers\submitController;
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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login',    [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});


// Protected routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout',             [AuthController::class, 'logout'])->name('logout');
    Route::post('sent',               [submitController::class, 'create'])->name('sent');
    Route::post('/pay',               [RaveController::class, 'initialize'])->name('pay');
    Route::post('/save-transfer',     [RaveController::class, 'saveTransferInfo'])->name('save-pages-transfer-details');
    Route::get('/rave/callback',      [RaveController::class, 'callback'])->name('callback');

    Route::get('/',                   [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard',          [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/deposit',            [PageController::class, 'deposit'])->name('deposit');
    Route::get('/transactions',       [PageController::class, 'transactions'])->name('transactions');
    Route::get('/checkout',           [PageController::class, 'checkout'])->name('checkout');
    Route::get('/account-settings',   [PageController::class, 'accountSettings'])->name('account-settings');

});





