@extends('admin.dashbord.layouts')
@section('title', 'Orders Management')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Orders Management</h4>

        <a href="{{ route('admin.orders.create') }}" class="btn btn-success">
            <i class="bx bx-plus"></i> Add New Order
        </a>
    </div>
    <x-alert />
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Orders</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Restaurant</th>
                            <th>Total Amount</th>
                            <th>Members</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th width="250">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $order->restaurant?->title ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ number_format($order->totalprice, 2) }} EGP
                                </td>

                                  <td>
                                    {{ $order->number_of_members }}
                                </td>

                                <td>
                                    {{ $order->pay_status->name }}
                                </td>

                                <td>
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>

                                <td>
                                    <div class="d-flex gap-1">

                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                            <i class="bx bx-show"></i>
                                            View
                                        </a>

                                        <a href="{{ route('order.member.create', ['order' => $order]) }}" class="btn btn-success btn-sm">
                                            <i class="bx bx-plus"></i>
                                            Add Item
                                        </a>

                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bx bx-trash"></i>
                                                Delete
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.orders.Details', $order->id) }}" class="btn btn-info btn-sm">
                                            <i class="bx bx-show"></i>
                                             Invoice 
                                        </a>


                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No Orders Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
