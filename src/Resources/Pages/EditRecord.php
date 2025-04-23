<?php

namespace FF\FilamentTools\Resources\Pages;

use Filament\Resources\Pages\EditRecord as FilamentEditRecord;
use Filament\Actions;

abstract class EditRecord extends FilamentEditRecord
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
