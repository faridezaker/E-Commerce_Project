<?php

namespace Zaker\User\Providers;

use Illuminate\Support\ServiceProvider;
use Zaker\User\Models\User;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        config()->set('auth.providers.users.model',User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/','User');
    }
}
