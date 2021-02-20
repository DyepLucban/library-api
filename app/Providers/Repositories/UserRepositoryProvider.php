<?php

namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Models\User;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function() {
            return new UserRepository(new User);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
