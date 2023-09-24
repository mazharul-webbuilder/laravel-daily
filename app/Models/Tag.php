<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

//    public function posts()
//    {
//        return $this->belongsToMany(related: Post::class, table: 'post_tag', foreignPivotKey: 'tag_id', relatedPivotKey: 'post_id');
//    }

        public function posts()
        {
            return $this->morphedByMany(Post::class, 'taggable');
        }

        public function videos()
        {
            return $this->morphedByMany(Video::class, 'taggable');
        }
}
