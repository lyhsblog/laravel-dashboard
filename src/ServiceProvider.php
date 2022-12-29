<?php
namespace Ybzc\Laravel\Dashboard;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class ServiceProvider extends RouteServiceProvider
{
    private $_packageTag = 'dashboard';

    public function register()
    {
        parent::register();
        $this->loadViewsFrom(__DIR__ . '/resources/views/', $this->_packageTag);
    }


    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->getRoutes()->refreshNameLookups();
        Route::aliasMiddleware("dashboard.view", DashboardView::class);
        $this->publishes([
            __DIR__ . '/config/adminlte.php' => config_path('adminlte.php'),
        ],'dashboard');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        if($this->getRoutes()->getByName("dashboard")) {
            Log::debug("attach middleware->".DashboardView::class.", ON->".static::class.", line->".__LINE__);
            $this->getRoutes()->getByName("dashboard")->middleware(['dashboard.view']);
        }
    }
}
