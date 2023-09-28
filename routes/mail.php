<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;

Route::get('/mail', function (){
    Mail::to('loveless2016rr@gmail.com')->send(new TestMail());
    dd('successfully message sent');
});
