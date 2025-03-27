<?php

use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Transaction;
use Illuminate\Support\Facades\Route;


Route::get("/",Login::class)->name("web.login");

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',Dashboard::class)->name('web.dashboard');
    Route::get('/transactions',Transaction::class)->name('web.transaction');
    //logout
    Route::get('/logout', [Dashboard::class, 'logout'])->name('web.logout');
});