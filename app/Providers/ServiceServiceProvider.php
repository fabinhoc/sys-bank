<?php

namespace App\Providers;

use App\Services\DepositServiceInterface;
use App\Services\Eloquent\DepositService;
use App\Services\Eloquent\ExpenseService;
use App\Services\Eloquent\UserService;
use App\Services\ExpenseServiceInterface;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(DepositServiceInterface::class, DepositService::class);
        $this->app->bind(ExpenseServiceInterface::class, ExpenseService::class);
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
