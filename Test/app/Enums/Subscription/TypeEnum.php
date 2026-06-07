<?php

namespace App\Enums\Subscription;

enum TypeEnum : int
{
    case Document = 1;
    case Course = 2;
    public function label(): string
    {
        return match($this) {
            self::Document => 'Document',
            self::Course => 'Course',
        };
    }
}
