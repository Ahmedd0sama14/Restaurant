<?php

namespace App\Http\Requests;

use App\Enums\Course\CourseDiscountTypeEnum;
use App\Enums\Course\CourseDurationTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCourseRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'discount_type' => ['nullable', new Enum(CourseDiscountTypeEnum::class)],
            'duration' => ['required', 'numeric', 'min:0'],
            'duration_type' => [ 'required',  new Enum(CourseDurationTypeEnum::class) ],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'course_type_id' => ['required', 'exists:course_types,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'introduction_video' => ['nullable', 'mimes:mp4,mov,avi,wmv', 'max:50000'],
        ];
    }
}
