<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function answers()
    {
        return $this->hasMany(StudentExamAnswer::class);
    }

}
