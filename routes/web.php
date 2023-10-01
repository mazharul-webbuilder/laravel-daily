<?php

use App\Http\Controllers\TwilioSMSController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');



require __DIR__ . '/eloquent-relationship.php';
require __DIR__ . '/mail.php';
require __DIR__ . '/multi-auth.php';
require __DIR__ . '/role_permission.php';

/*Twilio SMS OTP Sent*/
Route::get('sendSmsOTP', [TwilioSMSController::class, 'index']);
