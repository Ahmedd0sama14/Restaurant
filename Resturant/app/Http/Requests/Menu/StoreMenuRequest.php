<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item'=>['required','string','max:255'],
            'price'=>['required','numeric'],
            'image'=>['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
