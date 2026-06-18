<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\AddItemRequest;
use App\Http\Requests\Order\UpdateQuantityRequest;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMember;
use App\Models\OrderMemberItem;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class OrderMemberItemController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order, OrderMember $orderMember)
    {
        $selectedmenus=$orderMember->items()->pluck('menu_id');
        $menus = $order->restaurant->menus->whereNotIn('id', $selectedmenus)->all();
        if(isEmpty($menus)){
            return redirect()->route('admin.orders.show', [$order])->with('error', 'No more items available');
        }

        return view('admin.order-member-items.create', compact('order', 'orderMember', 'menus'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddItemRequest $request, Order $order, OrderMember $orderMember)
    {
        dd($request->all());

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
                    'quantity' => $item['quantity'],
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
   public function update(UpdateQuantityRequest $request, Order $order, $item)
    {
        $data = $request->validated();
        $orderMemberItem = OrderMemberItem::find($item);
        $oldQuantity=$orderMemberItem->quantity;
        $difference=$data['quantity']-$oldQuantity;
        $order->update([
            'totalprice' => $order->totalprice + $orderMemberItem->price * $difference,
            'number_of_items' => $order->number_of_items + $difference
        ]);
        $orderMemberItem->update([
            'quantity' => $data['quantity']
        ]);
        return redirect()->route('admin.orders.show', [$order])->with('success', 'Item quantity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, OrderMember $orderMember, OrderMemberItem $orderMemberItem)
    {
        $order->update([
            'totalprice' => $order->totalprice - $orderMemberItem->price * $orderMemberItem->quantity,
            'number_of_items' => $order->number_of_items - $orderMemberItem->quantity,
        ]);
        $orderMemberItem->delete();
        if ($orderMember->items->count() == 0) {
            $orderMember->delete();
            $order->decrement('number_of_members',1);
        }
        return redirect()->route('admin.orders.show', [$order])->with('success', 'Item deleted successfully');
    }
    public function deleteMenber(Order $order, OrderMember $orderMember)
    {
       $memberTotalPrice = $orderMember->items->sum(fn ($item) => $item->price * $item->quantity);
       $quantity = $orderMember->items->sum(fn ($item) => $item->quantity);
       $order->update([
            'totalprice' => $order->totalprice - $memberTotalPrice,
            'number_of_items' => $order->number_of_items - $quantity,
        ]);
        $orderMember->items()->delete();
        $orderMember->delete();
        $order->decrement('number_of_members',1);
        return redirect()->route('admin.orders.show', [$order])->with('success', 'Member deleted successfully');

    }

}
