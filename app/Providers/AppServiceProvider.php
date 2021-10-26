<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\InvoiceDetail;
use App\Observers\Invoice_detailObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        InvoiceDetail::observe(Invoice_detailObserver::class);
    }
}
