<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (session('level') != 1) {
          $onlyHrd = 'disabled';
        }else {
          $onlyHrd = '';
        }

        view()->share('onlyHrd', $onlyHrd);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
