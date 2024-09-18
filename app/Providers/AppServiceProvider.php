<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format('d M Y H:i:s'); ?>";
        });

        Blade::directive('formatTime', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format('H:i'); ?>";
        });

        Blade::directive('onlyDate', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format('d M Y'); ?>";
        });
        Paginator::useBootstrapFive();

    }
}
