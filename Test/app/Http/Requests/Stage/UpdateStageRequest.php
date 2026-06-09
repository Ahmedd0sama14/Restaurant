<?php

namespace App\Http\Requests\Stage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStageRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'en'=>['array','required'],
            'en.title'=>['required','string','max:255'],
            'ar'=>['array','required'],
            'ar.title'=>['required','string','max:255'],
        ];
    }
}
