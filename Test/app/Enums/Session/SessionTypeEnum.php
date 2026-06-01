<?php

namespace App\Enums\Session;

enum SessionTypeEnum : int
{
    case audio = 1;
    case video = 2;

    public function label(): string
    {
        return match($this) {
            self::audio => 'Audio',
            self::video => 'Video',
        };
    }
}
