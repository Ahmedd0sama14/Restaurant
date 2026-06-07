<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'Type'=>$this->Type,
            'subscribable_id'=>$this->subscribable_id,
            'subscribable_type'=>$this->subscribable_type,
            'price'=>$this->price,
            'image'=>url('storage/'.$this->image),
            'teacher_id'=>$this->teacher_id,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at,
        ];
    }
}
