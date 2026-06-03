<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',
        'path',
        'Teacher_id',
        'price'
    ];
    public function Teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
