<?php

namespace App\Enums\Course;

enum CourseDiscountTypeEnum: int
{
    case Percentage = 1;
    case Amount = 2;
    public function label(): string
    {
        return match ($this) {
            self::Percentage => 'Percentage',
            self::Amount => 'Amount',
        };
    }
}
