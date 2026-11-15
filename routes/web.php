<?php

use App\Http\Controllers\KursController;
use App\Service\ParsingService;
use Illuminate\Support\Facades\Route;

Route::get('/{currency}', [KursController::class, 'index']);
Route::get('/', [KursController::class, 'indexAll']);
