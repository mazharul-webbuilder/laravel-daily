<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Post-update policy
     *
     * Here shown single and multi-user approach
    */
    public function update(User|Admin $user, Post $post): bool
    {
        // single user approach
        return $user->getAttribute('id') === $post->getAttribute('creator_id');

        // multi-user-approach
        if ($user instanceof Admin){
            return $user->hasRole('editor') || $user->hasPermissions('post-update-permission'); // use spatie/role-permission package to manage role permissions
        }
        return $user->getAttribute('id') === $post->getAttribute('creator_id');
    }

    // Please check Policy_Single_and_Multi_auth.md file and PolicyController.php to get details

    // If you still stuck please check OTT project respected files.
}
