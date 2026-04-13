<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[ItemController::class, 'index']);


Route::middleware(['auth', 'verified'])->group(function () {
    
 
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    
});

Route::redirect('/home', '/mypage/profile');
 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
//Route::get('/register', [RegisterController::class, 'create'])->name('register');

//Route::post('/register', [RegisterController::class, 'store']);