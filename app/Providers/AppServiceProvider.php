<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\HeaderComposer; 
use App\View\Composers\FooterComposer; 
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            [
                'components.header.header',
                'components.responsive-navbar.responsive-navbar',
                'front.includes.header',
                'front.includes.responsive-navbar'
            ],
            HeaderComposer::class
        );
        View::composer(
            [
                'components.footer.footer',
                'front.includes.footer'
            ],
            FooterComposer::class
        );
    }
}
