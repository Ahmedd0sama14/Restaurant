<?php

namespace App\Enums\Course;

enum CourseDurationTypeEnum: int
{
    case Days = 1;
    case Weeks = 2;
    case Months = 3;

    public function label(): string
    {
        return match($this) {
            self::Days => 'Days',
            self::Weeks => 'Weeks',
            self::Months => 'Months',
        };
    }

}
