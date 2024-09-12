<?php

namespace App\Providers;

use RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to tenant admin's application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The path to tenant users' application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const DOCUMENTS = '/documents';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes() {
        foreach($this->centralDomains() as $domain){
            Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));
        }
    }

    protected function mapApiRoutes() {
        foreach($this->centralDomains() as $domain){
            Route::middleware('api')
                    ->prefix('api')
                    ->domain($domain)
                    ->group(base_path('routes/api.php'));
        }
    }

    protected function centralDomains() {
        return config('tenancy.central_domains');
    }
}