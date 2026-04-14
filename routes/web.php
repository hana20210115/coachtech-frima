<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;


Route::get('/',[ItemController::class, 'index'])->name('item.index');

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
});

 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');

//Route::get('/register', [RegisterController::class, 'create'])->name('register');

//Route::post('/register', [RegisterController::class, 'store']);