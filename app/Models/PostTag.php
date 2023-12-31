<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    use HasFactory;

    protected $table = 'post_tag';

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($item){
            /*The code will execute if any new record is created it the post_tag table*/
        });

        static::delete(function ($item){
            /*The code will execute if any  record is deleted it the post_tag table*/
        });
    }


}
