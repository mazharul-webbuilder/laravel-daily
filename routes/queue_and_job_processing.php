<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\Myjob;

Route::get('queue-nd-job', function (){
    dispatch(new Myjob('I am from a controller'));
});
