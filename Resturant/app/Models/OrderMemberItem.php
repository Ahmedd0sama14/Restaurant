<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMemberItem extends Model
{
    protected $fillable = [
        'order_id',
        'order_member_id',
        'menu_id',
        'price',
        'quantity',
        'pay_status',
    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function order_member()
    {
        return $this->belongsTo(OrderMember::class);
    }
}