<?php

namespace FF\FilamentTools\Core\Enums;

enum Color: string
{
    case RED = 'red';

    case BLUE = 'blue';

    case GREEN = 'green';

    case YELLOW = 'yellow';

    case PURPLE = 'purple';

    case CYAN = 'cyan';

    case DEFAULT = 'default';

    public function text(): string
    {
        return match ($this) {
            self::RED => '紅色',
            self::BLUE => '藍色',
            self::GREEN => '綠色',
            self::YELLOW => '黃色',
            self::PURPLE => '紫色',
            self::CYAN => '青色',

        };
    }

    static function options(): array
    {
        return [
            self::RED->value => self::RED->text(),
            self::BLUE->value => self::BLUE->text(),
            self::GREEN->value => self::GREEN->text(),
            self::YELLOW->value => self::YELLOW->text(),
            self::PURPLE->value => self::PURPLE->text(),
            self::CYAN->value => self::CYAN->text(),
        ];
    }
}
