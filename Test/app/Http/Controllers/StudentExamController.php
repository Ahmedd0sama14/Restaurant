<?php

namespace App\Http\Controllers;

use App\Models\StudentExam;
use App\Models\User;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function index()
    {
        $studentExams = StudentExam::with('exam','user')->get();
        return view('admin.exams.details.index', compact('studentExams'));
    }
 public function userExamDetails($userId, $examId)
{
    $user = User::findOrFail($userId);

    $studentExam = StudentExam::with([
        'user',
        'exam',
        'answers.question.answers'
    ])->where('user_id', $userId)->where('exam_id', $examId)->firstOrFail();

    return view('admin.exams.details.show', compact('studentExam', 'user'));
}
}
