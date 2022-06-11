<?php

namespace App\Providers;

use App\Services\GetUserInformation;
use App\Services\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Telegram::class,function(){
            return new Telegram(new Http(),env("TELEGRAM_ORDER_BOT_ID"));
        });
        $this->app->bind(GetUserInformation::class,function(){
            return new GetUserInformation(new Agent());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
