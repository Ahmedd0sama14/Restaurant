<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionWithAnswersRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'exam_id' =>['nullable','integer'],
            'title' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'numeric', 'min:1'],
            'answers' => ['required', 'array', 'min:2'],
            'answers.*' => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'integer','min:0'],
        ];
    }
}
