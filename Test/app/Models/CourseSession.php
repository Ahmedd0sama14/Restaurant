<?php

namespace App\Models;

use App\Enums\Session\SessionTypeEnum;
use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    protected $fillable = [
        'course_id',
        'session_type',
        'file',
    ];
    protected $casts = [
       'session_type' => SessionTypeEnum::class
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
