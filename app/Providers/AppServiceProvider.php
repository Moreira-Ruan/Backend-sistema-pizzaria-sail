<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use app\Services\UserServiceInterface;
use app\Services\UserService;
use app\Services\PizzaServiceInterface;
use app\Services\PizzaService;
use app\Services\AuthServiceInterface;
use app\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(\App\Services\AuthServiceInterface::class, \App\Services\AuthService::class);

        $this->app->bind(PizzaServiceInterface::class, PizzaService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(Carbon::now()->addMinutes(60));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMinutes(120));
    }
}