<?php

namespace App\Http\Requests\Partner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'en'=>['nullable','array'],
            'en.title'=>['nullable','string','max:255'],
            'en.description'=>['nullable','string','max:255'],
            'ar'=>['nullable','array'],
            'ar.title'=>['nullable','string','max:255'],
            'ar.description'=>['nullable','string','max:255'],
        ];
    }
}
