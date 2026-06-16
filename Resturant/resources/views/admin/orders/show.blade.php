@extends('admin.dashbord.layouts')

@section('title', 'Order Details - #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Order Details - #{{ $order->id }}</h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
            <i class="bx bx-arrow-back"></i> Back to Orders
        </a>
    </div>

    <x-alert />

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bx bx-receipt"></i> Order #{{ $order->id }}
            </h4>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3">
                    <strong>Restaurant:</strong>
                    <p>{{ $order->restaurant?->title ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Branch:</strong>
                    <p>{{ $order->branch?->address ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Total Price:</strong>
                    <p class="fw-bold text-success fs-5">
                        {{ number_format($order->total_price ?? $order->totalprice, 2) }} EGP
                    </p>
                </div>
                <div class="col-md-3">
                    <strong>Members:</strong>
                    <p>{{ $order->number_of_members ?? $order->members->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-3">Order Members</h5>

    @foreach ($order->members as $member)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    👤 {{ $member->admin?->name ?? 'Unknown User' }}
                </h5>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success fs-6">
                        Total: {{ number_format($member->total, 2) }} EGP
                    </span>

                    <a href="{{ route('order-members.items.create', [$order,$member])}}" class="btn btn-success btn-sm">
                        <i class="bx bx-plus"></i> Add Item
                    </a>

                    <form action="" method="POST" onsubmit="return confirm('Delete this member and all items?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="bx bx-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Menu Item</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Quantity </th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($member->items as $item)
                            <tr>
                                <td>{{ $item->menu?->item ?? ($item->menu?->title ?? 'Deleted Item') }}</td>
                                <td>{{ number_format($item->price / ($item->order->number_of_members   ?: 1), 2) }} EGP</td>
                                <td class="fw-semibold">{{ number_format($item->price, 2) }} EGP</td>
                                <td>
    {{ $item->menu && $item->menu->price > 0
        ? $item->price / $item->menu->price
        : 0 }}
</td>
                                <td>
                                    <form action="{{ route('order-members.items.destroy', [$order,$member,$item]) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No items</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endsection
