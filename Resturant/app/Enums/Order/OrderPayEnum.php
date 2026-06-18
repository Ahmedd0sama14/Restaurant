<?php
namespace App\Enums\Order;
Enum OrderPayEnum :int
{
    case UNPAID = 0;
    case PAID = 1;

    public function label(): string
    {
        return match($this) {
            self::UNPAID => 'unpaid',
            self::PAID => 'paid',
        };
    }

}
