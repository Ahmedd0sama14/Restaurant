@extends('admin.dashbord.layouts')
@section('title', 'Add New Items')

@section('content')
    <div class="container-xxl py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Add Items to Member</h4>
            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back to Order
            </a>
        </div>

        <x-alert />

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5>
                    Member: <strong>{{ $orderMember->admin?->name ?? 'Unknown' }}</strong>
                    <small class="text-muted">(Order #{{ $order->id }})</small>
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('order-members.items.store', [$order, $orderMember]) }}" method="POST" id="addItemsForm">
                    @csrf

                    <div id="itemsContainer">

                        <!-- First Row -->
                        <div class="item-row row g-3 mb-3 border rounded p-3">
                            <div class="col-md-4">
                                <label class="form-label">Menu Item <span class="text-danger">*</span></label>
                                <select name="items[0][menu_id]" class="form-select menuSelect" required>
                                    <option value="">-- Select Item --</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                                            {{ $menu->item ?? $menu->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Unit Price</label>
                                <input type="text" class="form-control unitPrice bg-light" readonly>
                                <input type="hidden" name="items[0][unit_price]" class="unitPriceHidden">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="items[0][quantity]" class="form-control quantity" value="1" min="1" required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Total Price</label>
                                <input type="text" class="form-control totalPrice bg-light" readonly>
                                <input type="hidden" name="items[0][total_price]" class="totalPriceHidden">
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger removeItem w-100">Remove</button>
                            </div>
                        </div>

                    </div>

                    <button type="button" id="addItemBtn" class="btn btn-success mb-4">
                        <i class="bx bx-plus"></i> Add Another Item
                    </button>

                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bx bx-save"></i> Save All Items
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let itemIndex = 1;

    function calculateRow(row) {
        const select = row.querySelector('.menuSelect');
        const qtyInput = row.querySelector('.quantity');
        const unitPriceEl = row.querySelector('.unitPrice');
        const unitPriceHidden = row.querySelector('.unitPriceHidden');
        const totalPriceEl = row.querySelector('.totalPrice');
        const totalPriceHidden = row.querySelector('.totalPriceHidden');

        const unitPrice = parseFloat(select.selectedOptions[0]?.dataset.price || 0);
        const qty = parseInt(qtyInput.value || 1);
        const total = unitPrice * qty;

        unitPriceEl.value = unitPrice.toFixed(2);
        unitPriceHidden.value = unitPrice;
        totalPriceEl.value = total.toFixed(2);
        totalPriceHidden.value = total;
    }

    // Add new row
    document.getElementById('addItemBtn').addEventListener('click', function () {
        const container = document.getElementById('itemsContainer');
        const firstRow = document.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);

        // Reset new row
        newRow.querySelector('.menuSelect').selectedIndex = 0;
        newRow.querySelector('.quantity').value = 1;
        newRow.querySelector('.unitPrice').value = '';
        newRow.querySelector('.totalPrice').value = '0.00';

        // Update names with new index
        newRow.querySelectorAll('[name]').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, `[${itemIndex}]`);
        });

        container.appendChild(newRow);
        itemIndex++;
    });

    // Calculate on change
    document.getElementById('itemsContainer').addEventListener('change', function (e) {
        if (e.target.classList.contains('menuSelect') || e.target.classList.contains('quantity')) {
            calculateRow(e.target.closest('.item-row'));
        }
    });

    // Remove row
    document.getElementById('itemsContainer').addEventListener('click', function (e) {
        if (e.target.classList.contains('removeItem')) {
            if (document.querySelectorAll('.item-row').length > 1) {
                e.target.closest('.item-row').remove();
            }
        }
    });

    // Initial calculation
    window.addEventListener('load', () => {
        document.querySelectorAll('.item-row').forEach(row => calculateRow(row));
    });
</script>
@endpush
