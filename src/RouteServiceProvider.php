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
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        Route::aliasMiddleware("dashboard.view", DashboardView::class);
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
        if($route = $this->getRoutes()->getByName("dashboard")) {
            Log::debug("attach middleware->".DashboardView::class.", ON->".static::class.", line->".__LINE__);
            $route->middleware(['dashboard.view']);
        }
    }
}
