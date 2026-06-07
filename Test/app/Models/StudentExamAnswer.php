<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    protected $fillable = [
        'student_exam_id',
        'question_id',
        'question_answer_id',
        'is_correct',
        'grade',
    ];

    public function questionAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function studentExam()
    {
        return $this->belongsTo(StudentExam::class);
    }
}
