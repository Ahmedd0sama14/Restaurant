<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Traits\RespondTrait;

class ExamQuestionsController extends Controller
{ use RespondTrait;
    public function showall()
    {
        $exams=Exam::with('questions.answers')->get();
        return $this->successResponse( ExamResource::collection($exams), 'Success', 200);
    }
 public function show($id)
    {
        $exam=Exam::with('questions.answers')->findOrFail($id);
        return $this->successResponse( new ExamResource($exam), 'Success', 200);
    }


}
