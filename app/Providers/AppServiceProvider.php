<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        //
       
        View::composer('*', function ($view) {
            $view->with('sharedFormat', ["osy" => "On Site (your premises)", "oso" =>"On Site (our premises)", "vff" => "Virtual Face to Face"]);
            $view->with('sharedCertificate', ["cert_tra" => "Certificate of Achievement (assessed by trainer)", "cert_ext" =>"Certificate of Achievement (assessed externally)", "other" => "Other"]);
            $view->with('sharedRegions', ['London - England', 'East Midlands - England', 'West Midlands - England', 'North East - England', 'North West - England', 'South West - England', 'South East - England', 'Yorkshire & The Humber - England', 'Scotland', 'Wales', 'Northern Ireland']);
            $view->with('sharedDurModes', ['h' => 'Hours', 'd' => 'Days']);
        });
    }
}
