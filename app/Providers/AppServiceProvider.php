<?php

namespace App\Providers;

use App\Models\Model;
use App\Policies\CarPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView("pagination");

        Gate::define("car-update", [CarPolicy::class, "update"]);
    }
}
