<?php

namespace App\Http\Requests\Subscription;

use App\Enums\Subscription\TypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'Type'=>['required',Rule::enum(TypeEnum::class)],
            'type_id'=>['required','integer'],
            'image'=>['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
        ];
    }
}
