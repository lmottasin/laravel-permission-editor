<?php

namespace Lmottasin\LaravelPermissionEditor\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Lmottasin\LaravelPermissionEditor\Console\Commands\CreateTaskCommand;
use Lmottasin\LaravelPermissionEditor\Http\Middleware\SpatiePermissionMiddleware;

class PermissionEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Route::prefix('permission-editor')
            ->as('permission-editor.')
            // configurable permission middleware
            ->middleware(config('permission-editor.middleware', ['web', 'spatie-permission']))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
            });

        // views load
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'permission-editor');

        // publish resource files
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('permission-editor'),
            ], 'assets');

            // config file
            $this->publishes([
                __DIR__ . '/../../config/permission-editor.php' => config_path('permission-editor.php'),
            ], 'permission-editor-config');

            // load migrations without publishing
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            /*
             * if we want to publish the migration files and edit them
             * */

            /*$this->publishes([
                __DIR__ . '/../../database/migrations/2023_01_01_100000_create_tasks_table.php' =>
                    database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tasks_table.php'),

                // More migration files here
            ], 'migrations');*/

            // commands
            $this->commands([
                CreateTaskCommand::class
            ]);
        };

        // alias middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('spatie-permission', SpatiePermissionMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
