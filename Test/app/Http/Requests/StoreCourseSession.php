<?php

namespace App\Http\Requests;

use App\Enums\Session\SessionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCourseSession extends FormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => ['required', 'exists:courses,id'],
            'session_type' => ['required', new Enum(SessionTypeEnum::class)],
              'file' => [
                'required',
                'file',
                'max:50000',

                $this->input('session_type') == SessionTypeEnum::audio->value
                   ? 'mimes:mp3'
                    : 'mimes:mp4,mkv,mov',
            ],
        ];
    }
}
