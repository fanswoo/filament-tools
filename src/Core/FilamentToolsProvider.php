<?php

namespace FF\FilamentTools\Core;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentToolsProvider extends PackageServiceProvider
{
    public static string $name = 'filament-tools';

    public function packageBooted()
    {
        FilamentAsset::register([
            Css::make('core', __DIR__ . '/../../resources/dist/css/core.css'),
        ], 'fanswoo/filament-tools/css');
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-forms')
            ->hasViews();
    }
}
