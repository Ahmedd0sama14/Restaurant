<?php

namespace App\Http\Requests\EducationType;

use App\Enums\Education\TypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(TypeEnum::class)],
            'en' => ['required', 'array'],
            'en.title' => ['required', 'string', 'max:255'],
            'ar' => ['required', 'array'],
            'ar.title' => ['required', 'string', 'max:255'],

        ];
    }
}
