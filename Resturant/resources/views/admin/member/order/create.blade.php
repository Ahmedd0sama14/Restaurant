@extends('admin.dashbord.layouts')

@section('title', 'Add Myself To Order')

@section('content')
    <div class="container-xxl py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-semibold">
                    <i class="bx bx-user-plus"></i> Add My Order #{{ $order->id }}
                </h4>
                <span class="badge bg-primary fs-6">
                    Restaurant: {{ $order->restaurant->title }}
                </span>
            </div>

            <div class="card-body">
                <x-alert />

                <form action="{{ route('order.members.store', $order) }}" method="POST" id="orderForm">
                    @csrf

                    <h5 class="mb-3 fw-semibold text-muted">My Items</h5>
                    <div id="membersContainer"></div>

                    <hr class="my-4">

                    <!-- Hidden Fields -->
                    <input type="hidden" name="totalprice" id="hiddenTotalPrice" value="0">
                    <input type="hidden" name="number_of_items" id="hiddenTotalItems" value="0">
                    <input type="hidden" name="number_of_members" id="hiddenMembersCount" value="1">

                    <div class="text-end mt-4">
                        <h4>Total: <span id="totalAmount" class="text-success fw-bold">0.00</span> EGP</h4>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                            <i class="bx bx-save"></i> Save My Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let itemIndex = 0;
    const restaurantMenus = {!! json_encode($order->restaurant->menus) !!};

    let menuOptions = '<option value="">Select Item</option>';
    restaurantMenus.forEach(menu => {
        menuOptions += `<option value="${menu.id}" data-price="${menu.price}">
            ${menu.item ?? menu.title} 
        </option>`;
    });

    // إضافة اليوزر الحالي + إمكانية إضافة أصناف متعددة
    function initializeMyOrder() {
        const currentUserId = {{ auth('admin')->id() }};
        const currentUserName = "{{ auth('admin')->user()->name }}";

        const html = `
        <div class="member-box border p-4 mb-4 rounded shadow-sm bg-white" data-index="0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold text-primary">
                    👤 ${currentUserName} (You)
                </h6>
            </div>

            <!-- Member ID Hidden -->
            <input type="hidden" name="members[0][member_id]" value="${currentUserId}">

            <div class="member-items" data-item-index="1" id="itemsContainer">
                <!-- First item will be added automatically -->
            </div>

            <button type="button" id="addItemBtn" class="btn btn-outline-success btn-sm mt-3">
                <i class="bx bx-plus"></i> Add Another Item
            </button>
        </div>`;

        document.getElementById('membersContainer').innerHTML = html;
    }

    // إضافة صنف جديد
    function addNewItem() {
    const html = `
    <div class="row g-3 mb-3 member-item align-items-end">
        <div class="col-md-6">
            <select name="members[0][items][${itemIndex}][menu_id]"
                    class="form-select member-item-select" required>
                ${menuOptions}
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="members[0][items][${itemIndex}][quantity]"
                   value="1" min="1" class="form-control member-qty" required>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control member-price bg-light" readonly value="0.00">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-member-item w-100">×</button>
        </div>
        <input type="hidden" name="members[0][items][${itemIndex}][unit_price]"
               class="item-price" value="0">
    </div>`;

    document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', html);
    itemIndex++;
    updateTotal();
}

    // Event Listeners
    document.addEventListener('click', function(e) {
        if (e.target.id === 'addItemBtn' || e.target.closest('#addItemBtn')) {
            addNewItem();
        }

        if (e.target.classList.contains('remove-member-item')) {
            e.target.closest('.member-item').remove();
            updateTotal();
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('member-item-select') || e.target.classList.contains('member-qty')) {
            const row = e.target.closest('.member-item');
            if (row) {
                const unitPrice = parseFloat(row.querySelector('.member-item-select option:checked')?.dataset.price || 0);
                const qty = parseFloat(row.querySelector('.member-qty').value || 1);
                row.querySelector('.member-price').value = (unitPrice * qty).toFixed(2);
                row.querySelector('.item-price').value = unitPrice;
            }
            updateTotal();
        }
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.member-item').forEach(item => {
            total += parseFloat(item.querySelector('.member-price').value || 0);
        });

        document.getElementById('totalAmount').textContent = total.toFixed(2);
        document.getElementById('hiddenTotalPrice').value = total.toFixed(2);
        document.getElementById('hiddenTotalItems').value = document.querySelectorAll('.member-item').length;
    }

    // Initialize on page load
    window.addEventListener('load', () => {
        initializeMyOrder();
        addNewItem();           // إضافة أول صنف تلقائياً
    });

    document.getElementById('orderForm').addEventListener('submit', updateTotal);
</script>
@endpush
