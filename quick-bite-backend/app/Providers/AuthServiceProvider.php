<?php

namespace App\Providers;

use App\Http\Module\Currency\Policy\CurrencyPolicy;
use App\Http\Module\Employee\Policy\EmployeePolicy;
use App\Http\Module\Faq\Policy\FaqPolicy;
use App\Http\Module\Image\Policy\ImagePolicy;
use App\Http\Module\Item\Policy\ItemPolicy;
use App\Http\Module\ItemFeedback\Policy\ItemFeedbackPolicy;
use App\Http\Module\Limit\Policy\LimitPolicy;
use App\Http\Module\Menu\Policy\MenuPolicy;
use App\Http\Module\Order\Policy\OrderPolicy;
use App\Http\Module\Reservation\Policy\ReservationPolicy;
use App\Http\Module\User\Policy\UserPolicy;
use App\Http\Module\VisitFeedback\Policy\VisitFeedbackPolicy;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\Faq;
use App\Models\Image;
use App\Models\Item;
use App\Models\ItemFeedback;
use App\Models\Limit;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use App\Models\VisitFeedback;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Employee::class => EmployeePolicy::class,
        Currency::class => CurrencyPolicy::class,
        Faq::class => FaqPolicy::class,
        Image::class => ImagePolicy::class,
        Item::class => ItemPolicy::class,
        ItemFeedback::class => ItemFeedbackPolicy::class,
        Menu::class => MenuPolicy::class,
        Order::class => OrderPolicy::class,
        Reservation::class => ReservationPolicy::class,
        User::class => UserPolicy::class,
        VisitFeedback::class => VisitFeedbackPolicy::class,
        Limit::class => LimitPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
