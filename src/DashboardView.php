<?php
namespace Ybzc\Laravel\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class DashboardView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next)
    {
        Log::info("hit middleware -> ".static::class.", line -> ".__LINE__);
        $next($request);
        return Response::view("dashboard::dashboard.dashboard");
    }
}
