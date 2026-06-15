<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
protected $fillable = [
    'item',
    'price',
    'restaurant_id',
    'image'
];




public function restaurant()
{
    return $this->belongsTo(Restaurant::class);
}
}
