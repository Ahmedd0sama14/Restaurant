<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMember extends Model
{
    protected $fillable = [
        'order_id',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function items()
    {
        return $this->hasMany(OrderMemberItem::class);
    }
       public function getTotalPriceAttribute()
{
    return $this->items->sum(function ($item) {
        return $item->price * $item->quantity;
    });
}
}
