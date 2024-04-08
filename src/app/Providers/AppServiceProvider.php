<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Paginator::defaultView('vender.pagination.topics');

        // 本番環境ではURL生成でhttpsを強制
        if(env('APP_ENV') === 'product') {
            $url->forceScheme('https');
        }
        //
    }
}
