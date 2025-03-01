<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
    public function boot()
    {
        //
         // Register Custom Blade Directives
    Blade::directive('inventoryHealth', function ($expression) {
        return "<?php echo App\Helpers\InventoryHelper::calculateInventoryHealth($expression); ?>";
    });

    Blade::directive('formatDuration', function ($expression) {
        return "<?php echo App\Helpers\InventoryHelper::formatDuration($expression); ?>";
    });
    }
}
