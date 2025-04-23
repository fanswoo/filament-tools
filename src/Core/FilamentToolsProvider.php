<?php

namespace FF\FilamentTools\Core;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FilamentToolsProvider extends ServiceProvider
{

    public static string $name = 'filament-tools';

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ff-filament-tools');

        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/ff-filament-tools')
        ], 'views');

        Livewire::component('filament-tools::forms.components.file-upload/upload-button', \FF\FilamentTools\Forms\Components\FileUpload\UploadButton::class);
    }

    public function register()
    {
    }

}
