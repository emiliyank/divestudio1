<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CmStaticPage;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $footer_static_pages = CmStaticPage::where('is_in_footer', 1)
            ->where('status', \Config::get('constants.PAGE_STATUS_PUBLIC'))
            ->whereNull('date_deleted')
            ->get();

        $main_menu_static_pages = CmStaticPage::where('is_in_main_menu', 1)
            ->where('status', \Config::get('constants.PAGE_STATUS_PUBLIC'))
            ->whereNull('date_deleted')
            ->get();

        $unauth_static_pages = CmStaticPage::where('is_in_unauth', 1)
            ->where('status', \Config::get('constants.PAGE_STATUS_PUBLIC'))
            ->whereNull('date_deleted')
            ->get();
        
        \View::share('footer_static_pages', $footer_static_pages);
        \View::share('main_menu_static_pages', $main_menu_static_pages);
        \View::share('unauth_static_pages', $unauth_static_pages);
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
