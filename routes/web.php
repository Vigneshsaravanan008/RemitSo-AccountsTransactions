<?php

use App\Livewire\Dashboard;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::get("/",Login::class)->name("web.login");
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',Dashboard::class)->name('web.dashboard');

    //logout
    Route::get('/logout', [Dashboard::class, 'logout'])->name('web.logout');
});