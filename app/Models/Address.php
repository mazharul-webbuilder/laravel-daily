<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function user() // if you want to get owner() instead of user(), you must have to pass the foreign_key
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // usr_id foreign key of address table, id is primary key of users table
    }



}
