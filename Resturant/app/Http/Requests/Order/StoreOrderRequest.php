<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_id' =>['required','integer','exists:restaurants,id'],
            'branch_id'=>['required','integer','exists:branches,id'],
            'totalprice'=>['required','numeric'],
            'number_of_items'=>['required','numeric'],
            'number_of_members'=>['required','numeric','min:1'],
            'members'=>['required','array'],
            'members.*.admin_id' =>['required','integer','exists:admins,id'],
            'members.*.items'   => ['required', 'array', 'min:1'],
            'members.*.items.*.menu_id'   => ['required', 'integer', 'exists:menus,id'],
            'members.*.items.*.price'  => ['required', 'numeric'],
        ];
    }
}
