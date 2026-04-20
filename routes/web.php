<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;



Route::get('/',[ItemController::class, 'index'])->name('item.index');

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/item/{item_id}/like', [ItemController::class, 'Like'])->name('item.like');
Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchase.create');
});

 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');


Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');

Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');

