<?php

use App\Models\Address;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Route;



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

Route::get('/comments', function (){
$user = User::find(1);
$post = Post::find(1);

$post->comments()->create(([
'user_id' => $user->id,
'body' => 'Comment for Post'
]));

return Post::with('comments')->find(1);
});

Route::get('/many-to-many-morphs-with-pivot', function (){
$post = Post::find(1);

//    $post->tags()->create([
//        'name' => 'Laravel'
//    ]);
//
//    $post->tags()->attach(Tag::find(1));

//    return $post->tags;

$tag = Tag::find(1);
return $tag->videos;

});

/*Write sub query with also use whereHas*/
Route::get('where-has', function (){

    $country = 'Tunisia';

    $users = User::with('address')->whereHas('address', function ($query) use ($country){
        $query->where('country', $country);
    })->get();

    return $users;
});

