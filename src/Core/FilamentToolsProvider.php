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
//        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ff-filament-tools');

//        $this->publishes([
//            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/ff-filament-tools')
//        ], 'views');

//        Livewire::component('filament-tools::forms.components.file-upload/upload-button', \FF\FilamentTools\Forms\Components\FileUpload\UploadButton::class);

//        FilamentAsset::register([
//            AlpineComponent::make('file-upload', __DIR__ . '/../../resources/dist/forms/file-upload/file-upload.js'),
//            AlpineComponent::make('upload-button', __DIR__ . '/../../resources/dist/forms/file-upload/upload-button.js'),
//            AlpineComponent::make('upload-list', __DIR__ . '/../../resources/dist/forms/file-upload/upload-list.js'),
//        ], 'fanswoo/filament-tools/forms/file-upload');

        FilamentAsset::register([
            Css::make('core', __DIR__ . '/../../resources/dist/css/core.css'),
        ], 'fanswoo/filament-tools/css');
    }

//    public function configurePackage(Package $package): void
//    {
//        $package
//            ->name('filament-forms')
//            ->hasViews();
//    }
}
