<?php

namespace FF\FilamentTools\Core\Utils;

use Filament\Facades\Filament;

class Color
{

    static function getColor(int $key, int $depth): string
    {
        $panel = Filament::getCurrentPanel();

        $colorNames = [
            'primary',
            'danger',
            'purple',
            'info',
            'success',
            'warning',
        ];

        $colorName = $colorNames[$key % count($colorNames)];

        return $panel->getColors()[$colorName][$depth];
    }

    static function getColors(int $count, int $depth): array
    {
        $panel = Filament::getCurrentPanel();

        $colorNames = [
            'primary',
            'secondary',
            'danger',
            'purple',
            'info',
            'success',
            'warning',
        ];
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colorName = $colorNames[$i % count($colorNames)];
            $colors[] = $panel->getColors()[$colorName][$depth];
        }

        return $colors;
    }

}
