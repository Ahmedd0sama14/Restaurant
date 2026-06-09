<?php

namespace App\Models\Stages;

use Illuminate\Database\Eloquent\Model;

class StagesTranslation extends Model
{
    protected $table = 'stages_translations';
    protected $fillable = ['title'];
    public $timestamps = false;
}
