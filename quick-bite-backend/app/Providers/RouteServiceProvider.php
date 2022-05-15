<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Currency/Route/CurrencyRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Employee/Route/EmployeeRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Faq/Route/FaqRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Image/Route/ImageRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/ItemFeedback/Route/ItemFeedbackRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Item/Route/ItemRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Menu/Route/MenuRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Order/Route/OrderRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Reservation/Route/ReservationRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/User/Route/UserRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/VisitFeedback/Route/VisitFeedbackRoute.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('app/Http/Module/Limit/Route/LimitRoute.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
