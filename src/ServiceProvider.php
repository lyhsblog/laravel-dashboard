<?php

namespace Ybzc\Laravel\Dashboard;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    private $_packageTag = 'dashboard';
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->loadViewsFrom(__DIR__ . '/resources/views/', $this->_packageTag);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/adminlte.php' => config_path('adminlte.php'),
        ],'dashboard');
    }
}
