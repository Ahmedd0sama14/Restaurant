<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'item'=>['nullable','string','max:255'],
            'price'=>['nullable','numeric'],
            'image'=>['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
