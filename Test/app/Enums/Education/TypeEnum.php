<?php

namespace App\Enums\Education;
Enum TypeEnum: int
{
    case PRIMARY = 1;
    case ACADEMIC = 2;
    public function label(): string
    {
        return match($this) {
            self::PRIMARY => 'Primary',
            self::ACADEMIC => 'Academic',
        };
    }

}