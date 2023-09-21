<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => 'guest user'
        ]);
    }

    public function tags()
    {
        return $this->belongsToMany(related: Tag::class, table: 'post_tag', foreignPivotKey: 'post_id', relatedPivotKey: 'tag_id')
            ->using(PostTag::class)
            ->withTimestamps()
            ->withPivot('status'); // this will also retrieve the value of status when relation will loaded
    }
}
