<?php
namespace Ybzc\Laravel\Dashboard;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public function register()
    {
        parent::register();
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
        if($route = $this->getRoutes()->getByName("dashboard")) {
            Log::debug("attach middleware->".DashboardView::class.", ON->".static::class.", line->".__LINE__);
            $route->middleware(['dashboard.view']);
        }
    }
}
