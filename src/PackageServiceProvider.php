<?php

namespace DavidSchneiderInfo\LaravelUi;

#use Illuminate\Support\Facades\Route;
use DavidSchneiderInfo\LaravelUi\Console\Commands\InstallUiCommand;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public const PACKAGE_PATH = __DIR__;
    
    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallUiCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        #Route::mixin(new AuthRouteMethods);
    }
}
