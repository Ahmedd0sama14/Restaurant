<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'title',
        'hotline',
        ];
    public function images()
    {
        return $this->hasMany(RestaurantImage::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
