<?php

namespace App\Http\Requests;

use App\Enums\Course\CourseDiscountTypeEnum;
use App\Enums\Course\CourseDurationTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'discount_type' => ['required', Rule::enum(CourseDiscountTypeEnum::class)],
            'duration' => 'required|integer|min:1',

            'duration_type' => [
                'required',
                new Enum(CourseDurationTypeEnum::class),
            ],

            'teacher_id' => 'required|exists:teachers,id',
            'course_type_id' => 'required|exists:course_types,id',

            'image' => 'nullable|image|max:2048',

            'introduction_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
        ];
    }
}
