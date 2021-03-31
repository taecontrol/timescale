<?php

namespace Taecontrol\Timescale;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Taecontrol\Timescale\Commands\TimescaleCommand;

class TimescaleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('timescale')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_timescale_table')
            ->hasCommand(TimescaleCommand::class);
    }
}
