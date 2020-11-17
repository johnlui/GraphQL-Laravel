<?php

namespace GraphQL;

use Illuminate\Support\ServiceProvider;

class GraphQLProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            Handler::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishes([
            __DIR__.'/config/graphql.php' => config_path('graphql.php'),
            dirname(__DIR__).'/GraphApp' => app_path('GraphApp'),
        ]);
    }
}
