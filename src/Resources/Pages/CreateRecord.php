<?php

namespace FF\FilamentTools\Resources\Pages;

use Filament\Resources\Pages\CreateRecord as FilamentCreateRecord;

abstract class CreateRecord extends FilamentCreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
