<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionWithAnswersRequest;
use App\Http\Requests\UpdateQuestionWithAnswersRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->paginate(3);
        return view('admin.bankquestion.index', compact('questions'));
    }
    public function create()
    {
        $exams = Exam::all();
        return view('admin.bankquestion.create', compact('exams'));
    }
    public function store(StoreQuestionWithAnswersRequest $request)
    {
        try {
            DB::beginTransaction();
            $question = Question::create([
                'exam_id' => $request->exam_id,
                'title' => $request->title,
                'degree' => $request->degree,
            ]);
            foreach ($request->answers as $index => $answer) {
                $question->answers()->create([
                    'answer'     => $answer,
                    'is_correct' => ($index == $request->correct_answer) ? 1 : 0,
                ]);
            }
            DB::commit();
            return redirect()->route('bank-questions.index')->with('success', 'Question created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function edit(Question $question)
    {
         if ($question->exam_id !== null) {
        abort(403, 'This question is locked.');
    }
        $exams = Exam::all();
        $question->load('answers');
        return view('admin.bankquestion.edit', compact('question', 'exams'));
    }
    public function update(UpdateQuestionWithAnswersRequest $request, Question $question)
    {

        try {
            DB::beginTransaction();
            $question->update([
                'exam_id' => $request->exam_id,
                'title' => $request->title,
                'degree' => $request->degree,
            ]);
            $question->answers()->delete();
    foreach ($request->answers as $index => $answerText) {

            $question->answers()->create([
                'answer'     => $answerText,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

            DB::commit();
            return redirect()->route('bank-questions.index')->with('success', 'Question updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function destroy(Question $question)
    {
        if($question->exam_id !== null){
            abort(403, 'This question is locked.');
        }
        $question->delete();
        return redirect()->route('bank-questions.index')->with('success', 'Question deleted successfully.');
    }
}
