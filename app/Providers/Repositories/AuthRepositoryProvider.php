<?php

namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Models\User;

class AuthRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepository::class, function() {
            return new AuthRepository(new User);
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
