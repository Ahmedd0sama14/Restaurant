<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_type' => [
                'name' => $this->discount_type->name,
                'value' => $this->discount_type->value,
            ],
            'price_after_discount' => $this->price_after_discount,
            'duration' => $this->duration,
            'duration_type' => [
                'name' => $this->duration_type->name,
                'value' => $this->duration_type->value,
            ],
            'image' => url('storage/' . $this->image),
            'introduction_video' => url('storage/' . $this->introduction_video)
        ];
    }
}
