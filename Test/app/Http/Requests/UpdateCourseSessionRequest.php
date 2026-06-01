<?php

namespace App\Http\Requests;

use App\Enums\Session\SessionTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCourseSessionRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              'course_id' => ['required', 'exists:courses,id'],
            'session_type' => ['required', new Enum(SessionTypeEnum::class)],
              'file' => [
                'nullable',
                'file',
                'max:50000',

                $this->input('session_type') == SessionTypeEnum::audio->value
                   ? 'mimes:mp3'
                    : 'mimes:mp4,mkv,mov',
            ],
        ];
    }
}
