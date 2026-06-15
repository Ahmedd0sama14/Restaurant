<?php

namespace App\Models;

use App\Enums\Admin\AdminTypeEnum;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];
    protected $casts = [
        'role'=>AdminTypeEnum::class
    ];

}
