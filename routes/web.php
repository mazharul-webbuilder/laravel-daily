<?php

use App\Http\Controllers\TwilioSMSController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');



require __DIR__ . '/eloquent-relationship.php';

/*Twilio SMS OTP Sent*/
Route::get('sendSmsOTP', [TwilioSMSController::class, 'index']);
