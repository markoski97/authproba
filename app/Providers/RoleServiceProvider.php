<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('role2',function($role){
           return "<?php if(auth()->check() && auth()->user()->hasRole({$role})); ?>";
        });

        Blade::directive('endrole2',function($role){
            return"<?php endif; ?>";
        });
    }
}
