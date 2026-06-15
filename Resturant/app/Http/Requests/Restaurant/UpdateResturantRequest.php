<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResturantRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
             return [
            'title' => ['nullable', 'string', 'max:255'],
            'hotline' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'array'],
            'image.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'branches'              => ['nullable', 'array', 'min:1'],
            'branches.*.phone'      => ['nullable', 'string', 'max:255'],
            'branches.*.address'    => ['nullable', 'string', 'max:500'],

        ];

    }
}
