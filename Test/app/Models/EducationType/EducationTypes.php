<?php

namespace App\Models\EducationType;

use App\Enums\Subscription\TypeEnum;
use App\Models\EducationType\EducationTypesTranslation;
use App\Models\Stages\Stages;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class EducationTypes extends Model
{
    use Translatable;

    protected $table = 'education_types';

    public $translatedAttributes = ['title'];
        public $translationForeignKey = 'education_type_id';


    protected $fillable = ['type'];

    public $timestamps = false;

    protected $casts = [
        'type' => TypeEnum::class
    ];
    public function translations()
    {
        return $this->hasMany(EducationTypesTranslation::class, 'education_type_id', 'id');
    }
    public function Stages()
    {
        return $this->hasMany(Stages::class, 'education_type_id', 'id');
    }
}