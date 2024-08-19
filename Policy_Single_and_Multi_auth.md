# Laravel Policy

## Introduction

Laravel policies provide a convenient way to authorize actions for a user. This README will guide you through using Laravel policies for both single authentication and multi-guard users.

## Single Authentication User

For a single authentication setup, Laravel's default authentication system is used. Follow these steps to define and use policies:

### 1. Create a Policy

Generate a new policy using the Artisan command:
```bash
php artisan make:policy PostPolicy
```

This will create a PostPolicy class in the app/Policies directory.

### 2. Register the Policy
   Register the policy in the AuthServiceProvider located at app/Providers/AuthServiceProvider.php:
````
protected $policies = [
    'App\Models\Post' => 'App\Policies\PostPolicy',
];
````
### 3. Define Policy Methods
In the PostPolicy class, define methods to authorize actions:

````
public function view(User $user, Post $post)
{
    return $user->id === $post->user_id;
}

public function update(User $user, Post $post)
{
    return $user->id === $post->user_id;
}

````

### 4. Use the Policy
In your controllers or routes, use the authorize method:

````
public function show(Post $post)
{
    $this->authorize('view', $post);

    // Show the post
}

public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    // Update the post
}

````

### 4. Use the Policy
In your controllers or routes, use the authorize method:

````
public function show(Post $post)
{
    $this->authorize('view', $post);

    // Show the post
}

public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    // Update the post
}

````

### Multi-Guard User
For applications using multiple guards, you need to specify which guard the policy should apply to. Follow these steps:

### 1. Create a Policy
Generate a new policy using the Artisan command:
```angular2html
php artisan make:policy PostPolicy
```


### 2. Register the Policy
Register the policy in the AuthServiceProvider located at app/Providers/AuthServiceProvider.php:

```angular2html
protected $policies = [
    'App\Models\Post' => 'App\Policies\PostPolicy',
];
```


### 3. Define Policy Methods
In the PostPolicy class, define methods to authorize actions:
```
public function view(Admin $admin, Post $post)
{
    // Example for Admin guard
    return $admin->id === $post->admin_id;
}

public function update(User $user, Post $post)
{
    // Example for User guard
    return $user->id === $post->user_id;
}

```


### 4. Use the Policy with Multiple Guards

When using policies with multiple guards, specify the guard in the authorization calls:

```
public function show(Post $post)
{
    if (auth('admin')->check()) {
        $this->authorize('view', $post); // For Admin guard
    } else {
        $this->authorize('view', $post); // For User guard
    }

    // Show the post
}


```
Note
Ensure that you handle the guard logic appropriately in your policies and controllers to match the intended guard context.
