<?php

namespace App\Providers;

use App\Models\Bus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Observers\AuditTrailObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the observer for models
        Bus::observe(AuditTrailObserver::class);
    }
}
