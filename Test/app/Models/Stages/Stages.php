<?php

namespace App\Models\Stages;

use App\Enums\Stages\StagesTypeEnum;
use App\Models\EducationType\EducationTypes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Stages extends Model
{
use Translatable;
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'stage_id';
    protected $fillable = ['type','parent_id','education_type_id'];
    public $timestamps = false;

    protected $casts = [
        'type' => StagesTypeEnum::class
    ];
    public function parent()
    {
        return $this->belongsTo(Stages::class, 'parent_id');
    }
    public function educationType()
    {
        return $this->belongsTo(EducationTypes::class);
    }

    public function children()
    {
        return $this->hasMany(Stages::class, 'parent_id')->with('children');
    }
  
}
