<?php

namespace App\Providers;

use App\Http\ViewComposers\AdminStatsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\AccountStatsComposer;

class ComposerServiceProvider extends ServiceProvider
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

        View::composer('account.layouts.partials._stats',AccountStatsComposer::class);//so ovaj service provider prajme komponenta sho che prenesuva elementi vo viewto (NAMESTO VO CONTROLERO DA PRAJS COMPACT OVDE GI KLAVAS ELEMENTITE)
        View::composer('admin.layouts.partials.stats',AdminStatsComposer::class);//so ovaj service provider prajme komponenta sho che prenesuva elementi vo viewto (NAMESTO VO CONTROLERO DA PRAJS COMPACT OVDE GI KLAVAS ELEMENTITE)
    }
}
