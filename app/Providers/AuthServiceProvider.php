<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        /**
         * If you follow laravel naming convention with a model and policy,
         * The policy will auto register with a responding model
         */
        // If you want to register manually, do so
        Post::class => PostPolicy::class // whenever you use $this->authorize() on User instance,
        //laravel will check UserPolicy
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
        * For multi-guard authorization
         * Below code will give a superpower ability to role with 'Super Admin'
        */
        if (request()->user('admin')){
            Gate::before(function ($admin, $ability) {
                return $admin->hasRole('Super Admin') ? true : null;
            });
        }
    }
}
