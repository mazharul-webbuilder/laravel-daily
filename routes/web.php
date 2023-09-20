<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Address;


Route::get('/', [HomeController::class, 'index'])->name('home');

/*HasOne Relation*/
Route::get('/user', function (){
   return User::with('address')->get();
});
/*BelongTo Relation*/
Route::get('/address', function (){
    return Address::with('user')->find(1);
});

