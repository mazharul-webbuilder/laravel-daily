<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

        /*Will execute rest of the code*/
        dump($collection);

        /*Will not execute rest of the code*/
        dd($collection);
    }

    /**
     * This macro will create customize method which will be
     * performed over any collection
    */
    public function macro()
    {
        Collection::macro('cutomMakeUpperCase', function (){
            return $this->map(function ($value) {
                return Str::upper($value);
            });
        });

        $collection = collect(['first', 'second']);

        dd($collection->cutomMakeUpperCase());
    }

    public function chunk()
    {
        $collection = collect([1, 3, 4, 6, 7 ]);

        $chunks =  $collection->chunk(2);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $item) {
                echo 'Item' . $item . '</br>';
            }
        }
    }

    public function excepts()
    {
        $collection = collect([
            ['id' => 1, 'name' => 'Mazharul Islam', 'city' => 'Dhaka'],
            ['id' => 2, 'name' => 'Lammim Islam', 'city' => 'Cumilla']
        ]);

        $modifiedCollection = $collection->map(function ($item) {
            return collect($item)->except(['name', 'city'])->all();
        });

        return $modifiedCollection;
    }

}
