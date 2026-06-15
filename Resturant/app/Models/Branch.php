<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'restaurant_id',
        'phone',
        'address',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
