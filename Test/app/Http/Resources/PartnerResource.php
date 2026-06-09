<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {        $en = $this->translations->firstWhere('locale', 'en');
            $ar = $this->translations->firstWhere('locale', 'ar');

        return [
            'id' => $this->id,
            'title' => [
                'en' => $en->title,
                'ar' => $ar->title
            ],
            'description' =>    [
                'en' => $en->description,
                'ar' => $ar->description
            ]
        ];
    }
}
