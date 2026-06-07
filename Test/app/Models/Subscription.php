<?php

namespace App\Models;

use App\Enums\Subscription\StatusEnum;
use App\Enums\Subscription\TypeEnum;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'subscribable_id',
        'subscribable_type',
        'teacher_id',
        'Type',
        'status',
        'image',
        'price'
    ];
    protected $casts = [
        'status' => StatusEnum::class,
        'Type' => TypeEnum::class

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subscribable()
    {
        return $this->morphTo();
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
