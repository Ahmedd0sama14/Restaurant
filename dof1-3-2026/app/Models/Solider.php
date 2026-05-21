<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solider extends Model
{
    use HasFactory;

    protected $table = 'soldiers';
    protected $fillable = [
        'name',
        'rank',
        'military_number',
        'national_id',
        'transfer_order',
        'triple_1',
        'triple_2',
        'triple_3',
        'recruitment_date',
        'release_date',
        'center',
        'governorate',
        'height',
        'weight',
        'boot_size',
        'overall_size',
    ];
}
