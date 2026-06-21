<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderMember;
use Illuminate\Http\Request;

class MemberOrderController extends Controller
{
    public function index(Order $order)
    {
        $user = auth('admin')->user();

        return view('admin.member.order.create', compact('user', 'order'));
    }

}
