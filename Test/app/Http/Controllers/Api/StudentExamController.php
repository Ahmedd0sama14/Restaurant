<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreExamAnswerRequest;
use App\Models\QuestionAnswer;
use App\Models\StudentExam;
use App\Models\StudentExamAnswer;
use Illuminate\Support\Facades\DB;

class StudentExamController extends Controller
{
    public function store(StoreExamAnswerRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $studentExam = StudentExam::firstOrCreate([
                'user_id' => auth()->id(),
                'exam_id' => $data['exam_id'],
            ]);

            $studentExam->load('exam.questions');

            if (count($data['answers']) !== $studentExam->exam->questions->count()) {
                throw new \Exception('You must answer all questions.');
            }

            $totalGrade = 0;
            foreach ($data['answers'] as $answerData) {

                $questionAnswer = QuestionAnswer::with('question')
                    ->findOrFail($answerData['question_answer_id']);


                if ($questionAnswer->question_id != $answerData['question_id']) {
                    throw new \Exception('Invalid answer selected for question.');
                }

                $grade = $questionAnswer->is_correct
                    ? $questionAnswer->question->degree
                    : 0;

                $totalGrade += $grade;

                StudentExamAnswer::updateOrCreate(
                    [
                        'student_exam_id' => $studentExam->id,
                        'question_id'     => $answerData['question_id'],
                    ],
                    [
                        'question_answer_id' => $answerData['question_answer_id'],
                        'is_correct'         => (bool) $questionAnswer->is_correct,
                        'grade'              => $grade,
                    ]
                );
            }

            $studentExam->update([
                'grade' => $totalGrade,
            ]);

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Exam submitted successfully',
                'total_grade' => $totalGrade,
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
