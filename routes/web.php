<?php

use App\Http\Controllers\KursController;
use App\Service\ParsingService;
use Illuminate\Support\Facades\Route;

Route::get('/kurs/{currency}', [KursController::class, 'index']);
