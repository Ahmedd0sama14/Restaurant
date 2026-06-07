<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamAnswerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [
        'exam_id' => ['required', 'exists:exams,id'],

        'answers' => ['required', 'array', 'min:1'],

        'answers.*.question_id' => ['required','exists:questions,id'],

        'answers.*.question_answer_id' => ['required', 'exists:question_answers,id'],
    ];
}
}
