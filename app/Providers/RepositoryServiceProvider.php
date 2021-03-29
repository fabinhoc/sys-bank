<?php

namespace App\Providers;

use App\Repository\AccountRepositoryInterface;
use App\Repository\DepositRepositoryInterface;
use App\Repository\Eloquent\AccountRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\UserRepositoryInterface; 
use App\Repository\Eloquent\UserRepository; 
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\DepositRepository;
use App\Repository\Eloquent\ExpenseRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\ExpenseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DepositRepositoryInterface::class, DepositRepository::class);
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
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
