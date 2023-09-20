<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function ($user){
            Address::create([
               'user_id' => $user->id,
               'country' => fake()->country,
            ]);

            $post = Post::create([
                'user_id' => $user->id,
                'title' => fake()->sentence
            ]);

            $tag = Tag::create([
                'name' => fake()->name,
            ]);

            $post->tags()->attach($tag); // will create a record in post_tag table with post id and tag id
//            $post->tags()->detach($tag); // This will delete a record with associate post id
//            $post->tags()->detach(); // This will delete all tags related to this post

            /*To add extra column value data to pivot table*/
//            $post->tags()->attach([
//                1 => [
//                    'status' => 'approved'
//                ]
//            ]);

            /*To retrieve pivot table data do like so: $post->tags->first()->pivot->status*/
        });

    }
}
