@extends('admin.dashbord.layouts')

@section('title', 'Order Details - #' . $order->id)

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold text-secondary">
            <i class="bx bx-receipt text-primary"></i> Order Details <span class="text-primary">#{{ $order->id }}</span>
        </h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary px-3">
            <i class="bx bx-arrow-back"></i> Back to Orders
        </a>
    </div>

    <x-alert />

    {{-- ORDER INFO & FINANCIAL SUMMARY --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-info-circle me-1"></i> Main Order Information
            </h5>
        </div>

        <div class="card-body">
            <div class="row g-3 mb-4 text-center text-md-start">
                <div class="col-md-3 col-sm-6 border-end-md">
                    <span class="text-muted d-block small text-uppercase fw-bold">Restaurant</span>
                    <span class="fs-6 fw-semibold text-dark">{{ $order->restaurant?->title ?? 'N/A' }}</span>
                </div>
                <div class="col-md-3 col-sm-6 border-end-md">
                    <span class="text-muted d-block small text-uppercase fw-bold">Branch</span>
                    <span class="fs-6 text-dark">{{ $order->branch?->address ?? 'N/A' }}</span>
                </div>
                <div class="col-md-2 col-sm-4 border-end-md">
                    <span class="text-muted d-block small text-uppercase fw-bold">Members Count</span>
                    <span class="badge bg-label-primary fs-6 px-3 mt-1">{{ $order->number_of_members }} Members</span>
                </div>
                <div class="col-md-2 col-sm-4 border-end-md">
                    <span class="text-muted d-block small text-uppercase fw-bold">Total Items</span>
                    <span class="badge bg-label-secondary fs-6 px-3 mt-1">{{ $order->number_of_items ?? 0 }} Items</span>
                </div>
                <div class="col-md-2 col-sm-4">
                    <span class="text-muted d-block small text-uppercase fw-bold">Order Date</span>
                    <span class="text-dark small d-block mt-1">{{ $order->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <hr class="my-4 text-light">



            <h6 class="fw-bold mb-3 text-primary"><i class="bx bx-calculator me-1"></i> Financial Summary</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <span class="text-muted d-block small fw-bold">Items Total (إجمالي سعر الأكل)</span>
                        <span class="fs-5 fw-bold text-secondary">{{ number_format($order->totalprice - $order->services, 2) }} EGP</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <span class="text-muted d-block small fw-bold">Delivery Service (سيرفس التوصيل)</span>
                        <span class="fs-5 fw-bold text-warning">+ {{ number_format($order->services) }} EGP</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded" style="background-color: #e8f5e9;">
                        <span class="text-success d-block small fw-bold">Grand Total (الإجمالي الكلي المضاف له السيرفس)</span>
                        <span class="fs-4 fw-black text-success">{{ number_format($order->totalprice ) }} EGP</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MEMBERS SECTION --}}
    <div class="d-flex align-items-center mb-3 mt-5">
        <h5 class="mb-0 fw-bold text-dark"><i class="bx bx-group text-success me-1"></i> Order Members Items</h5>
        <span class="badge bg-secondary rounded-pill ms-2">{{ $order->members->count() }}</span>
    </div>
    <div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold">
                <i class="bx bx-group text-success"></i>
                Order Members
            </h5>
            <small class="text-muted">
                Manage order members and their items
            </small>
        </div>

        <a href="{{ route('order.members.create', $order) }}"
           class="btn btn-success">
            <i class="bx bx-user-plus"></i>
            Add New Member
        </a>
    </div>
</div>

    @foreach ($order->members as $member)

        <div class="card mb-4 border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center gap-3 py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-dark fs-6 d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 bg-white border rounded-circle p-1">👤</span>
                    {{ $member->admin?->name ?? 'Unknown User' }}
                </h6>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span class="badge bg-success fs-6 px-3 py-2">
                        Total: {{ number_format($member->total_price, 2) }} EGP
                    </span>

                    <a href="{{ route('order-members.items.create', [$order, $member]) }}" class="btn btn-success btn-sm px-2">
                        <i class="bx bx-plus"></i> Add Item
                    </a>

                    <form action="{{ route('order.members.destroy',[$order, $member,] ?? '') }}" method="POST" onsubmit="return confirm('Delete this member and all his items?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm px-2">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7">
                            <tr>
                                <th class="ps-4">Menu Item</th>
                                <th>Unit Price</th>
                                <th width="160">Quantity</th>
                                <th>Total Price (السعر)</th>
                                <th width="100" class="text-center pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($member->items as $item)
                                <tr>
                                    <td class="ps-4 fw-medium text-dark">
                                        {{ $item->menu?->item ?? ($item->menu?->title ?? 'Deleted Item') }}
                                    </td>
                                    <td>{{ number_format($item->price, 2) }} EGP</td>
                                    <td>
                                        <div class="quantity-container d-flex align-items-center"
                                             data-order-id="{{ $order->id }}" data-member-id="{{ $member->id }}"
                                             data-item-id="{{ $item->id }}">

                                            <div class="d-flex align-items-center gap-2 quantity-display-wrapper">
                                                <span class="quantity-display badge bg-label-dark fs-6 fw-bold px-2 py-1">
                                                    {{ $item->quantity ?? 1 }}
                                                </span>
                                                <button type="button" class="btn btn-sm btn-icon btn-outline-primary edit-btn p-1">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('order-members.items.update', [$order, $item]) }}"
                                                  method="POST"
                                                  class="quantity-edit-form d-none input-group input-group-sm">
                                                @csrf
                                                @method('PUT')

                                                <input type="number" name="quantity" value="{{ $item->quantity ?? 1 }}"
                                                       min="1" class="form-control text-center px-1" style="max-width: 65px;">

                                                <button type="submit" class="btn btn-success px-2">
                                                    <i class="bx bx-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-secondary cancel-edit px-2">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-dark fw-bold">
                                        {{ number_format($item->price * $item->quantity, 2) }} EGP
                                    </td>
                                    <td class="text-center pe-4">
                                        <form action="{{ route('order-members.items.destroy', [$order, $member, $item]) }}"
                                              method="POST" onsubmit="return confirm('Remove this item?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-link text-danger p-0 m-0 shadow-none">
                                                <i class="bx bx-trash-alt fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bx bx-info-circle d-block fs-3 mb-2"></i> No items found for this member
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Show Edit Form Mode
            $(document).on('click', '.edit-btn', function() {
                let container = $(this).closest('.quantity-container');
                container.find('.quantity-display-wrapper').addClass('d-none');
                container.find('.quantity-edit-form').removeClass('d-none').addClass('d-flex');
                container.find('input[name="quantity"]').focus().select();
            });

            // Cancel Edit Mode
            $(document).on('click', '.cancel-edit', function() {
                let container = $(this).closest('.quantity-container');
                container.find('.quantity-display-wrapper').removeClass('d-none');
                container.find('.quantity-edit-form').addClass('d-none').removeClass('d-flex');
            });

        });
    </script>
@endpush
