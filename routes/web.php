<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

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

// Seller Route

Route::prefix('seller')->group(function () {
    Route::get('/login', [SellerController::class, 'Index'])->name('seller.seller_form');
    Route::post('/login/owner', [SellerController::class, 'Login'])->name('seller.login');
    Route::get('/dashboard', [SellerController::class, 'Dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'Logout'])->name('seller.logout');
    Route::get('/registration', [SellerController::class, 'Registration'])->name('seller.registration');
    Route::post('/registration/create', [SellerController::class, 'RegistrationCreate'])->name('seller.registration.create');
});

// End Seller Route



// Admin Route

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'Index'])->name('admin.admin_form');
    Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'Logout'])->name('admin.logout');
    Route::get('/registration', [AdminController::class, 'Registration'])->name('admin.registration');
    Route::post('/registration/create', [AdminController::class, 'RegistrationCreate'])->name('admin.registration.create');
});

// End Admin Route

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
