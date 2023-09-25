<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LaravelCollectionController extends Controller
{
    public function index()
    {
        /*This will make a collection
        * Will convert all values to uppercase
         * Will reject from collection if value is empty
        */
        $collection = collect(['taylor', 'abigail', null])
            ->map(function (string $name = null){return strtoupper($name);})
            ->reject(function (string $name){return empty($name);});

        dd($collection);
    }
}
z
