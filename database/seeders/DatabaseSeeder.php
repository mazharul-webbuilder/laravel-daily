<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Post;
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

            Post::create([
                'user_id' => $user->id,
                'title' => fake()->sentence
            ]);
        });
    }
}
