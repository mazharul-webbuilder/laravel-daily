<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaravelCollectionController;


/*Every data retrieve from database are in collection form
You can perform any action laravel support over the retrieve data

Collection is a more extend version of PHP array offer by Laravel
*/
Route::prefix('laravel-collection')->controller(LaravelCollectionController::class)->group(function (){
    Route::get('/basic-filter', 'index');
    Route::get('/macro', 'macro');
    Route::get('/chunk', 'chunk');
    Route::get('/excepts', 'excepts');
});

