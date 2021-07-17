<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\NotificationUser;
use App\Models\Order;
use App\Observers\ModuleObserver;
use App\Observers\NotificationObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
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
        App::setLocale('en');
        Schema::defaultStringLength(191);
        Module::observe(ModuleObserver::class);
        NotificationUser::observe(NotificationObserver::class);
        Order::observe(OrderObserver::class);
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
