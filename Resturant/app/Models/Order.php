<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'branch_id',
        'totalprice',
        'number_of_members',
        'number_of_items'
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function members()
    {
        return $this->hasMany(OrderMember::class);
    }
    public function order_member_items()
    {
        return $this->hasMany(OrderMemberItem::class);
    }


}
