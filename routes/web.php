<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Address;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Project;



Route::get('/', [HomeController::class, 'index'])->name('home');

/*HasOne Relation*/
Route::get('/user', function (){
   return User::with('address')->get();
});
/*BelongTo Relation*/
Route::get('/address', function (){
    return Address::with('user')->find(1);
});

/*HasMany Relation*/
Route::get('/addresses', function (){
    return User::with('addresses')->find(1);
});

Route::get('/posts-with-user', function (){
    return Post::with('user')->get();
});

Route::get('/user-with-posts', function (){
    return User::has('posts')->with('posts')->get(); // Only those user who made post
    return User::has('posts', '>=', 2)->with('posts')->get(); // Only those user who has 2 or more posts


    /*Users who has Posts and post tile contain Voluptatum */
    return User::has('posts')->whereHas('posts', function ($query) {
        $query->where('title', 'like', '%Voluptatum%');
    })->with('posts')->get();

    /*Users who doesn't post*/
    return User::doesntHave('posts')->get();
});

Route::get('/post-with-tags', function (){
    return Post::has('tags')->with(['user', 'tags'])->get();
});

Route::get('/tags-with-posts', function (){
    return Tag::has('posts')->with('posts')->get();
});

Route::get('project-tasks', function (){
    return Project::with('tasks')->get();
});


Route::get('project-tasks2', function (){
    return Project::with('tasks')->get();
});


