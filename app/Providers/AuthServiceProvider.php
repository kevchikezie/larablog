<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Post::class => \App\Policies\PostPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();
        
        $this->registerPolicies();

        $this->registerPostPolicies();

        $this->registerCategoryPolicies();

        $this->registerUserPolicies();

    }

    /**
     * Register policies for post
     *
     * @return void
     */
    public function registerPostPolicies()
    {
        Gate::define('create-post', 'App\Policies\PostPolicy@create');
        Gate::define('view-post', 'App\Policies\PostPolicy@view');
        Gate::define('view-others-post', 'App\Policies\PostPolicy@viewOthers');
        Gate::define('update-post', 'App\Policies\PostPolicy@update');
        Gate::define('update-others-post', 'App\Policies\PostPolicy@updateOthers');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');
        Gate::define('delete-others-post', 'App\Policies\PostPolicy@deleteOthers');
        Gate::define('publish-post', 'App\Policies\PostPolicy@publish');
    }

    /**
     * Register policies for post category
     *
     * @return void
     */
    public function registerCategoryPolicies()
    {
        Gate::define('create-category', 'App\Policies\CategoryPolicy@create');
        Gate::define('view-category', 'App\Policies\CategoryPolicy@view');
        Gate::define('update-category', 'App\Policies\CategoryPolicy@update');
        Gate::define('delete-category', 'App\Policies\CategoryPolicy@delete');
    }

    /**
     * Register policies for user
     *
     * @return void
     */
    public function registerUserPolicies()
    {
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('view-user', 'App\Policies\UserPolicy@view');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');
        Gate::define('promote-user', 'App\Policies\UserPolicy@promote');
        Gate::define('deactivate-user', 'App\Policies\UserPolicy@deactivate');
    }
}
