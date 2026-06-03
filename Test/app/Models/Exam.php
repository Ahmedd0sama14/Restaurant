<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title',
        'image',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
