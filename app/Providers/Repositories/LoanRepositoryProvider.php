<?php

namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository;
use App\Repositories\LoanRepository;
use App\Repositories\UserRepository;
use App\Models\Loan;

class LoanRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoanRepository::class, function() {
            return new LoanRepository(
               new Loan,
               $this->app->make(UserRepository::class),
               $this->app->make(BookRepository::class)
            );
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
