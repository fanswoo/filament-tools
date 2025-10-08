<?php

namespace FF\FilamentTools\Forms\Components\MediaUpload;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class MediaUpload extends SpatieMediaLibraryFileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->disk(config('filesystems.media_disk'))
            ->acceptedFileTypes(['image/png', 'image/jpeg'])
            ->collection($this->name)
            ->openable()
            ->multiple()
            ->reorderable()
            ->appendFiles()
            ->downloadable()
            ->panelLayout('grid');
    }
}