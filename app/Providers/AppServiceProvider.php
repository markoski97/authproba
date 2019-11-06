<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('role1',function($role){
            return @"<?php if(auth()->check() && auth()->user()->hasRole({$role})); ?>";
        });

        Blade::directive('endrole1',function($role){
            return"<?php endif; ?>";
        });
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
