<?php
namespace App\Enums\Admin;
Enum AdminTypeEnum :int

{
    case MEMBER=1;
    case ADMIN= 2;
    case SUPERADMIN=3;

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'admin',
            self::SUPERADMIN => 'superadmin',
            self::MEMBER => 'member',
        };
    }
}
