<?php

namespace Laravel\Ui\Presets;

use DavidSchneiderInfo\LaravelUi\PackageServiceProvider;
use Illuminate\Filesystem\Filesystem;

class Bootstrap extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateViteConfiguration();
        static::updateSass();
        static::updateBootstrapping();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            'bootstrap' => '^5.2.1',
            '@popperjs/core' => '^2.10.2',
            'sass' => '^1.32.11',
        ] + $packages;
    }

    /**
     * Update the Vite configuration.
     *
     * @return void
     */
    protected static function updateViteConfiguration()
    {
        copy(PackageServiceProvider::PACKAGE_PATH.'/../stubs/bootstrap/vite.config.js', base_path('vite.config.js'));
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('sass'));

        copy(PackageServiceProvider::PACKAGE_PATH.'/../stubs/bootstrap/_variables.scss', resource_path('sass/_variables.scss'));
        copy(PackageServiceProvider::PACKAGE_PATH.'/../stubs/bootstrap/app.scss', resource_path('sass/app.scss'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(PackageServiceProvider::PACKAGE_PATH.'/../stubs/bootstrap/bootstrap.js', resource_path('js/bootstrap.js'));
    }
}
