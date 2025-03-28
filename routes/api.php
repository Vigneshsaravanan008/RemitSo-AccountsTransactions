<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/accounts', [ApiController::class,'createAccount']);
Route::get('/accounts/{account_number}', [ApiController::class,'accountDetails']);
Route::put('/accounts/{account_number}', [ApiController::class,'accountUpdateDetails']);
Route::delete('/accounts/{account_number}', [ApiController::class,'accountDeleteDetails']);
Route::post('/transactions', [ApiController::class,'accountTransactions']);
Route::get('/transactions', [ApiController::class,'accountTimeTransactions']);
