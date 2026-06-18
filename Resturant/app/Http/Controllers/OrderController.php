<?php

namespace App\Http\Controllers;

use App\Enums\Admin\AdminTypeEnum;
use App\Http\Requests\Order\AddMemberRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderMember;
use App\Models\OrderMemberItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

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
        DB::beginTransaction();
        try {
            $members = $data['members'];
            unset($data['members']);
            $data['totalprice']+=$data['services'];
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
                        'price'           => $item['unit_price'],
                        'quantity'        => $item['quantity'],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Order created successfully');
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
    public function createMember(Order $order)
    {
        $users = Admin::where('role', AdminTypeEnum::MEMBER)
        ->whereNotIn('id', $order->members()->pluck('admin_id'))->get();
        $order->load('restaurant.menus');
       if(!$users->count()){
        return redirect()->route('admin.orders.show', [$order])->with('error', 'No more members available');
       }
        return view('admin.orders.create-member', compact('order', 'users'));
    }
    public function storeMember(AddMemberRequest $request, Order $order)
    {

        $data = $request->validated();
        DB::beginTransaction();
        try
        {
         $members = $data['members'];
        $order->update([
            'totalprice' => $order->totalprice + $data['totalprice'],
            'number_of_items' => $order->number_of_items + $data['number_of_items'],
            'number_of_members'=>$order->number_of_members+$data['number_of_members'],
        ]);
        foreach ($members as $member) {

    $orderMember = OrderMember::create([
        'order_id' => $order->id,
        'admin_id' => $member['member_id'],
    ]);
    foreach ($member['items'] as $menuItem) {

        OrderMemberItem::create([
            'order_id'        => $order->id,
            'order_member_id' => $orderMember->id,
            'menu_id'         => $menuItem['menu_id'],
            'price'           => $menuItem['unit_price'],
            'quantity'        => $menuItem['quantity'],
        ]);
    }}
            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Order Updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
