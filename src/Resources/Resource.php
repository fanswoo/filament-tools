<?php

namespace FF\FilamentTools\Resources;

use Filament\Resources\Resource as FilamentResource;

abstract class Resource extends FilamentResource
{
    static function getPluralModelLabel(): string
    {
        return static::$navigationLabel;
    }
}
