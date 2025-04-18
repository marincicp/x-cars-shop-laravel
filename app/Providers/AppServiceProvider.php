<?php

namespace App\Providers;

use App\Models\Model;
use App\Policies\CarCommentPolicy;
use App\Policies\CarPolicy;
use App\Policies\UserPolicy;
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
        Model::shouldBeStrict();
        Paginator::defaultView("pagination");
        Gate::define("car-update", [CarPolicy::class, "update"]);
        Gate::define("user-update", [UserPolicy::class, "update"]);
        Gate::define("comment-delete", [CarCommentPolicy::class, "delete"]);
    }
}
