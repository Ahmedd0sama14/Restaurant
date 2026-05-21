<?php

namespace App\Models;

use App\Enums\Course\CourseDiscountTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'discount',
        'discount_type',
        'price',
        'price_after_discount',
        'duration',
        'duration_type',
        'teacher_id',
        'course_type_id',
        'image',
        'introduction_video',
    ];
    protected $casts = [
    'discount_type' => CourseDiscountTypeEnum::class,
];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseTypes::class);
    }
}
