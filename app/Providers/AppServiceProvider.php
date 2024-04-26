<?php

namespace App\Providers;

use App\Models\ContentOwner;
use App\Models\Publisher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        //
        View::share('contentOwners', ContentOwner::all());

        View::share('publishers', Publisher::all());

    }
}