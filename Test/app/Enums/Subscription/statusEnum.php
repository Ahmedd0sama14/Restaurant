<?php

namespace App\Enums\Subscription;

enum StatusEnum: int
{
    case pending = 0;
    case accpeted = 1;
    case rejected = 2;
    public function label(): string
    {
        return match ($this) {
            self::pending => 'Pending',
            self::accpeted => 'Accepted',
            self::rejected => 'Rejected',
        };
    }
}
