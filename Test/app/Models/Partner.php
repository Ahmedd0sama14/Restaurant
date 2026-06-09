<?php

namespace App\Models;

use App\Models\PartnerTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use Translatable;
    protected $table = 'partners';
    public $translatedAttributes = ['title', 'description'];
    public $timestamps = false;
    public function translations()
    {
        return $this->hasMany(PartnerTranslation::class);
    }
}
