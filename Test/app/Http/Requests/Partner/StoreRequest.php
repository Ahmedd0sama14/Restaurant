<?php

namespace App\Http\Requests\Partner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'en'=>['required','array'],
            'en.title'=>['required','string','max:255'],
            'en.description'=>['required','string','max:255'],
            'ar'=>['required','array'],
            'ar.title'=>['required','string','max:255'],
            'ar.description'=>['required','string','max:255'],
        ];
    }
}
