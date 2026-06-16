<?php

namespace App\Http\Controllers;

use App\Enums\Admin\AdminTypeEnum;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderMember;
use App\Models\OrderMemberItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('restaurant', 'members', 'order_member_items')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::with('branches', 'menus')->get();
        $users = Admin::where('role', AdminTypeEnum::MEMBER)->get();
        return view('admin.orders.create', compact('restaurants', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        dd($data);
        DB::beginTransaction();
        try {
            $members = $data['members'];
            unset($data['members']);
            $order = Order::create($data);

            foreach ($members as $member) {
                $orderMember = OrderMember::create([
                    'order_id' => $order->id,
                    'admin_id' => $member['admin_id'],
                ]);

                foreach ($member['items'] as $item) {

                    OrderMemberItem::create([
                        'order_id'        => $order->id,
                        'order_member_id' => $orderMember->id,
                        'menu_id'         => $item['menu_id'],
                        'price'           => $item['price'],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.orders.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load([
            'restaurant',
            'members.admin',
            'members.items.menu'
        ]);
      
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
