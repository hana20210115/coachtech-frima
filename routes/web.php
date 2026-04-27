<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;



Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');


Route::middleware(['auth', 'verified'])->group(function () {
    

    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

 
    Route::get('/sell', [ItemController::class, 'create'])->name('sell.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');

     Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress'])->name('purchase.address.edit');
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');



    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/success/{item_id}', [PurchaseController::class, 'success'])->name('purchase.success');
 

 
    Route::post('/item/{item_id}/like', [ItemController::class, 'Like'])->name('item.like');
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('comment.store');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');