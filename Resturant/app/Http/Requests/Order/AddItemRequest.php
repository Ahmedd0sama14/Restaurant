<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddItemRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items'=> 'required|array',
            'items.*.quantity' => 'required|numeric',
            'items.*.menu_id' => 'required|numeric',
            'items.*.unit_price' => 'required|numeric',
            'items.*.total_price' => 'required|numeric',
            
        ];
    }
}
