<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;




Route::get('/', [HomeController::class, 'index'])->name('home');



require __DIR__ . '/eloquent-relationship.php';
