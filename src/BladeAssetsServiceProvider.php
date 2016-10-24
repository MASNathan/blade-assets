<?php

namespace MASNathan\BladeAssets;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use MASNathan\BladeAssets\View\Factory;

class BladeAssetsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton(Factory::class);

        View::composer('*', function ($view) use ($app) {
            $view->with('bladeAssetsFactory', $app[Factory::class]);
        });

        Blade::directive('script', function ($expression) {
            return "<?php \$bladeAssetsFactory->compileScript($expression); ?>";
        });

        Blade::directive('endscript', function () {
            return "<?php \$bladeAssetsFactory->compileEndScript(); ?>";
        });

        Blade::directive('style', function ($expression) {
            return "<?php \$bladeAssetsFactory->compileStyle($expression); ?>";
        });

        Blade::directive('endstyle', function () {
            return "<?php \$bladeAssetsFactory->compileEndStyle(); ?>";
        });

        Blade::directive('outputStyles', function () {
            return "<?php \$bladeAssetsFactory->compileOutput('styles'); ?>";
        });

        Blade::directive('outputScripts', function () {
            return "<?php \$bladeAssetsFactory->compileOutput('scripts'); ?>";
        });
    }
}
