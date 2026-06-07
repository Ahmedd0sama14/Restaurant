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

            $studentExam = StudentExam::firstOrCreate(
                [
                    'user_id' => auth()->id(),
                    'exam_id' => $data['exam_id'],
                ]
            );

            $totalGrade = 0;
            foreach ($data['answers'] as $answerData) {

                $answer = QuestionAnswer::findOrFail(
                    $answerData['question_answer_id']
                );

                $result = $this->calculateDegree(
                    $answerData['question_answer_id']
                );
                $totalGrade += $result['grade'];
                StudentExamAnswer::updateOrCreate(
                    [
                        'student_exam_id' => $studentExam->id,
                        'question_id'     => $answerData['question_id'],
                    ],
                    [
                        'question_answer_id' => $answerData['question_answer_id'],
                        'is_correct'         => $result['is_correct'],
                        'grade'              => $result['grade'],
                    ]
                );
            }
            $studentExam->update([
                'grade' => $totalGrade,
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Exam submitted successfully',
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
    private function calculateDegree(int $questionAnswerId): array
    {
        $answer = QuestionAnswer::with('question')
            ->findOrFail($questionAnswerId);

        return [
            'is_correct' => (bool) $answer->is_correct,
            'grade'   => $answer->is_correct ? $answer->question->degree : 0,
        ];
    }
}
