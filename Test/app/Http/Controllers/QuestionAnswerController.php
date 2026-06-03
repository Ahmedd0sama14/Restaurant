<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    public function index(Exam $exam,Question $question)
    {
        $answers = $question->answers;
        return view('admin.exams.answers.index', compact('exam', 'question', 'answers'));
    }
    public function create(Exam $exam,Question $question)
    {
        return view('admin.exams.answers.create', compact('exam', 'question'));
    }
    public function store(StoreAnswerRequest $request, Exam $exam,Question $question)
    {
        if($request->is_correct){
            $question->answers()->update(['is_correct' => 0]);
        }
        $question->answers()->create($request->all());
        return redirect()->route('questions.index', [$exam, $question]);
    }
    public function edit(Exam $exam,Question $question,QuestionAnswer $answer)
    {
        return view('admin.exams.answers.edit', compact('exam', 'question', 'answer'));
    }
    public function update(UpdateAnswerRequest $request, Exam $exam,Question $question,QuestionAnswer $answer)
    {
        $data=$request->validated();
        if ($request->is_correct) {
            $question->answers()->update(['is_correct' => 0]);
        }
        $answer->update($data);
        return redirect()->route('answers.index', [$exam, $question]);
    }
    public function destroy(Exam $exam,Question $question,QuestionAnswer $answer)
    {
        $answer->delete();
        return redirect()->route('answers.index', [$exam, $question]);
    }
}
