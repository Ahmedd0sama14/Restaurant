<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => url('storage/' . $this->image),
            'questions' => $this->questions->map(function ($question) {
                return [
                    'title' => $question->title,
                    'degree' => $question->degree,
                    'answers' => $question->answers->map(function ($answer) {
                        return [
                            'answer' => $answer->answer,
                            'is_correct' => $answer->is_correct,
                        ];
                    }),
                ];
            }),
        ];
    }
}
