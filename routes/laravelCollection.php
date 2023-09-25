<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaravelCollectionController;

Route::prefix('laravel-collection')->controller(LaravelCollectionController::class)->group(function (){
    Route::get('/', 'index');
});

