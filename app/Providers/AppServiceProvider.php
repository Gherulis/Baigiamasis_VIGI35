<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\declareWater;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['declare.create','declare.show'], function ($view) {
            $view->with('lastData', $lastData = declareWater::where('flat_id', Auth::user()->flat_id)
            ->orderBy('id', 'desc')
            ->first());
        });
        Schema::defaultStringLength(191);
    }

    //pasiziurek dabar duombaze
}
