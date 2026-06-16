<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\AddItemRequest;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMember;
use App\Models\OrderMemberItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderMemberItemController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order, OrderMember $orderMember)
    {
        $menus = $order->restaurant->menus;

        return view('admin.order-member-items.create', compact('order', 'orderMember', 'menus'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddItemRequest $request, Order $order, OrderMember $orderMember)
    {

        $data = $request->validated();
        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $totalItems = 0;
            foreach ($data['items'] as $item) {
                $totalPrice = $totalPrice + $item['total_price'];
                $totalItems = $totalItems + $item['quantity'];

                OrderMemberItem::create([
                    'order_id' => $order->id,
                    'order_member_id' => $orderMember->id,
                    'menu_id' => $item['menu_id'],
                    'price' => $item['unit_price'],
                ]);
            }
            $order->update([
                'totalprice' => $order->totalprice + $totalPrice,
                'number_of_items' => $order->number_of_items + $totalItems,
            ]);
            DB::commit();

            return redirect()->route('admin.orders.show', [$order])->with('success', 'Item added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order,OrderMember $orderMember,OrderMemberItem $orderMemberItem)
    {
        $order->update([
            'totalprice' => $order->totalprice - $orderMemberItem->price,
            'number_of_items' => $order->number_of_items - 1
        ]);
        $orderMemberItem->delete();
        return redirect()->route('admin.orders.show', [$order])->with('success', 'Item deleted successfully');

    }
}
