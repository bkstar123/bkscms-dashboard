<?php
/**
 * DashboardServiceProvider
 *
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */

namespace Bkstar123\BksCMS\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Bkstar123\BksCMS\Dashboard\Services\Dashboard;
use Bkstar123\BksCMS\Dashboard\Contracts\Dashboard as DashboardContract;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bkstar123_bkscms_dashboard');
        $this->publishes([
            __DIR__.'/../config/bkstar123_bkscms_dashboard.php' => config_path('bkstar123_bkscms_dashboard.php'),
        ], 'bkstar123_bkscms_dashboard.config');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/bkstar123_bkscms_dashboard'),
        ], 'bkstar123_bkscms_dashboard.views');
        $this->publishes([
            __DIR__.'/../resources/js' => public_path('js/vendor/bkstar123_bkscms_dashboard'),
        ], 'bkstar123_bkscms_dashboard.assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bkstar123_bkscms_dashboard.php',
            'bkstar123_bkscms_dashboard'
        );
        $this->app->singleton(DashboardContract::class, Dashboard::class);
    }
}
