<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionWithAnswersRequest;
use App\Http\Requests\UpdateQuestionWithAnswersRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Exam $exam)
    {
        $questions = $exam->questions()->with('answers')->withCount('answers')->paginate(3)->withQueryString();
        return view('admin.exams.question.index', compact('exam', 'questions'));
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create(Exam $exam)
    {
        return view('admin.exams.question.create', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionWithAnswersRequest $request, Exam $exam)
    {
        try {
            DB::beginTransaction();
            $question = Question::create([
                'exam_id' => $exam->id,
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
            return redirect()->route('questions.index', $exam->id);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam, Question $question)
    {
        $question->load('answers');
        return view('admin.exams.question.edit', compact('exam', 'question'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionWithAnswersRequest $request, Exam $exam, Question $question)
    {
        DB::beginTransaction();
        try {
            $question->update(['title' => $request->title,'degree' => $request->degree]);
            $question->answers()->delete();
            foreach ($request->answers as $index => $answer) {

                $question->answers()->create([
                    'answer'     => $answer,
                    'is_correct' => ($index == $request->correct_answer) ? 1 : 0,
                ]);

            }
            DB::commit();
            return redirect()->route('questions.index', $exam->id);
        } catch (\Exception $e) {
            DB::rollBack();
            // optionally log the exception
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index', $exam->id);
    }
}
