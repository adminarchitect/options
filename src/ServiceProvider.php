<?php

namespace Terranet\Options;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Terranet\Options\Console\OptionMakeCommand;
use Terranet\Options\Console\OptionRemoveCommand;
use Terranet\Options\Console\OptionsTableCommand;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if (! defined('_TERRANET_OPTIONS_')) {
            define('_TERRANET_OPTIONS_', 1);
        }

        $baseDir = realpath(__DIR__ . '/');
        $this->publishes(["{$baseDir}/routes.php" => app_path('Http/Terranet/Options/routes.php')], 'routes');

        if (! $this->app->routesAreCached()) {
            if (file_exists($routes = app_path('Http/Terranet/Options/routes.php'))) {
                /** @noinspection PhpIncludeInspection */
                require_once $routes;
            } else {
                /** @noinspection PhpIncludeInspection */
                require_once "{$baseDir}/routes.php";
            }
        }
    }

    public function register()
    {
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $this->app->singleton('terranet.options', function ($app) {
            return new Manager($app);
        });

        $this->app->singleton('command.options.table', function ($app) {
            return new OptionsTableCommand($app['files'], $app['composer']);
        });

        $this->app->singleton('command.options.make', function ($app) {
            return new OptionMakeCommand($app['files'], $app['composer']);
        });

        $this->app->singleton('command.options.remove', function ($app) {
            return new OptionRemoveCommand($app['files'], $app['composer']);
        });

        $this->commands(['command.options.table', 'command.options.make', 'command.options.remove']);
    }
}
