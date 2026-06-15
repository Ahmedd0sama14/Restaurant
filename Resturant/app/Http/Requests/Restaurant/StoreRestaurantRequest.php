<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'hotline' => ['required', 'string', 'max:255'],
            'image' => ['required', 'array'],
            'image.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'branches'              => ['required', 'array', 'min:1'],
            'branches.*.phone'      => ['required', 'string', 'max:255'],
            'branches.*.address'    => ['required', 'string', 'max:500'],

        ];
    }
}
