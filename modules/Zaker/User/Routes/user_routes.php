<?php

use Illuminate\Support\Facades\Route;
use Zaker\User\Http\Controllers\ProfileController;

Route::group(["namespace"=>'Zaker\User\Http\Controllers','middleware'=>'web'],function ($router){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
});
