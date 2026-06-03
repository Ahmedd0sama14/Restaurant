<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'balance',
    ];
    public function Documents()
    {
        return $this->hasMany(Document::class);
    }
}
