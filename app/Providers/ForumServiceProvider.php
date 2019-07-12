<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ForumService;

class ForumServiceProvider extends ServiceProvider
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
      $this->app->bind('App\Services\Contracts\ForumService', function ($app) {
          return new ForumService();
        });
    }
}
