<?php

namespace common\Modules\Image\Enums;

enum ResizeEnum: string
{
    case MINIMAL = 'min';
    case MEDIUM = 'medium';
    case LARGE = 'large';

    public function sizeHeight(): int
    {
        return match ($this) {
            self::MINIMAL => 240,
            self::MEDIUM => 600,
            self::LARGE => 1200
        };
    }
}
