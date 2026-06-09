<?php

namespace App\Http\Requests\Stage;

use App\Enums\Stages\StagesTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreStageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required','integer', new Enum(StagesTypeEnum::class)],
            'parent_id' => ['nullable','integer','exists:stages,id'],
            'education_type_id' => ['required','integer'],
            'en'=>['required','array'],
            'en.title'=>['required','string','max:255'],
            'ar'=>['required','array'],
            'ar.title'=>['required','string','max:255'],
        ];
    }
}
