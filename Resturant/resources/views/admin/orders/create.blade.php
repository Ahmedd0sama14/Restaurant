@extends('admin.dashbord.layouts')
@section('title', 'Create New Order')
@section('content')
    <div class="container-xxl py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0 fw-semibold">
                    <i class="bx bx-cart-add"></i> Create New Order
                </h4>
            </div>

            <div class="card-body">
                <x-alert />

                <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
                    @csrf

                    {{-- Restaurant & Branch --}}
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Restaurant <span class="text-danger">*</span></label>
                            <select name="restaurant_id" id="restaurantSelect" class="form-select" required>
                                <option value="">Choose Restaurant</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}"
                                            data-hotline="{{ $restaurant->hotline }}"
                                            data-menus="{{ $restaurant->menus->toJson() }}"
                                            data-branches="{{ $restaurant->branches->toJson() }}">
                                        {{ $restaurant->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Branch <span class="text-danger">*</span></label>
                            <select name="branch_id" id="branchSelect" class="form-select" required>
                                <option value="">Select Restaurant First</option>
                            </select>
                        </div>
                    </div>

                    <!-- Branch Info -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Restaurant Hotline</label>
                            <input type="text" id="restaurantHotline" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Branch Phone</label>
                            <input type="text" id="branchPhone" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Branch Address</label>
                            <input type="text" id="branchAddress" class="form-control bg-light" readonly>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Order Members</h5>
                    <div id="membersContainer"></div>

                    <button type="button" id="addMemberBtn" class="btn btn-success mb-4">
                        + Add New Member
                    </button>

                    <!-- Hidden Totals -->
                    <input type="hidden" name="totalprice" id="hiddenTotalPrice" value="0">
                    <input type="hidden" name="number_of_items" id="hiddenTotalItems" value="0">
                    <input type="hidden" name="number_of_members" id="hiddenMembersCount" value="0">

                    <div class="text-end mt-4">
                        <h4>Total: <span id="totalAmount" class="text-success fw-bold">0.00</span> EGP</h4>
                    </div>
                  <div class="col-md-4">
                   <label class="form-label">Add Services</label>
                    <input type="number" name="services" class="form-control" min="0">
                </div>
                    <button type="submit" class="btn btn-primary btn-lg mt-4 px-5">
                        Create Order
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let memberIndex = 0;
    const restaurantSelect = document.getElementById('restaurantSelect');
    const branchSelect = document.getElementById('branchSelect');

    // تغيير المطعم
    restaurantSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        document.getElementById('restaurantHotline').value = option.dataset.hotline || '';

        const branches = JSON.parse(option.dataset.branches || '[]');
        branchSelect.innerHTML = '<option value="">Select Branch</option>';

        branches.forEach(branch => {
            const opt = document.createElement('option');
            opt.value = branch.id;
            opt.textContent = branch.address;
            opt.dataset.phone = branch.phone;
            opt.dataset.address = branch.address;
            branchSelect.appendChild(opt);
        });

        document.getElementById('membersContainer').innerHTML = '';
        memberIndex = 0;
        updateTotal();
    });

    // تغيير الفرع
    branchSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        document.getElementById('branchPhone').value = option.dataset.phone || '';
        document.getElementById('branchAddress').value = option.dataset.address || '';
    });

    // إضافة عضو جديد
    document.getElementById('addMemberBtn').addEventListener('click', function() {
        if (!restaurantSelect.value) {
            alert('Please select a restaurant first');
            return;
        }

        const menus = JSON.parse(restaurantSelect.options[restaurantSelect.selectedIndex].dataset.menus || '[]');
        let menuOptions = '<option value="">Select Item</option>';
        menus.forEach(menu => {
            menuOptions += `
                <option value="${menu.id}" data-price="${menu.price}">
                    ${menu.item ?? menu.title}
                </option>`;
        });

        const html = `
        <div class="member-box border p-3 mb-4" data-index="${memberIndex}">
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <h6 class="mb-0">Member ${memberIndex + 1}</h6>
                <button type="button" class="btn btn-danger btn-sm remove-member">Remove</button>
            </div>

            <select name="members[${memberIndex}][admin_id]" class="form-select mb-3 member-admin-select" required>
                <option value="">Select Member</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <div class="member-items" data-item-index="1">
                <div class="row g-2 mb-2 member-item">
                    <div class="col-md-4">
                        <select name="members[${memberIndex}][items][0][menu_id]"
                                class="form-select member-item-select" required>
                            ${menuOptions}
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="members[${memberIndex}][items][0][quantity]"
                               value="1" min="1" class="form-control member-qty" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control member-price bg-light" readonly value="0.00">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-member-item">×</button>
                    </div>
                    <input type="hidden" name="members[${memberIndex}][items][0][unit_price]"
                           class="item-price" value="0">
                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm add-member-item mt-2">+ Add Another Item</button>
        </div>`;

        document.getElementById('membersContainer').insertAdjacentHTML('beforeend', html);

        refreshMemberOptions();
        refreshItemOptions(); // التأكد من تصفية القوائم فور إضافة الصندوق الجديد
        memberIndex++;
        updateTotal();
    });

    // تفويض الأحداث لجميع العمليات داخل الصناديق الديناميكية
    document.addEventListener('click', function(e) {
        // إضافة صنف جديد لنفس العضو
        if (e.target.classList.contains('add-member-item')) {
            const memberBox = e.target.closest('.member-box');
            const memberIdx = memberBox.dataset.index;
            let itemIdx = parseInt(memberBox.querySelector('.member-items').dataset.itemIndex || 1);

            const menus = JSON.parse(restaurantSelect.options[restaurantSelect.selectedIndex].dataset.menus || '[]');
            let menuOptions = '<option value="">Select Item</option>';
            menus.forEach(m => {
                menuOptions += `<option value="${m.id}" data-price="${m.price}">${m.item ?? m.title} </option>`;
            });

            const html = `
            <div class="row g-2 mb-2 member-item">
                <div class="col-md-4">
                    <select name="members[${memberIdx}][items][${itemIdx}][menu_id]"
                            class="form-select member-item-select" required>${menuOptions}</select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="members[${memberIdx}][items][${itemIdx}][quantity]"
                           value="1" min="1" class="form-control member-qty" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control member-price bg-light" readonly value="0.00">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-member-item">×</button>
                </div>
                <input type="hidden" name="members[${memberIdx}][items][${itemIdx}][unit_price]"
                       class="item-price" value="0">
            </div>`;

            memberBox.querySelector('.member-items').insertAdjacentHTML('beforeend', html);
            memberBox.querySelector('.member-items').dataset.itemIndex = itemIdx + 1;

            refreshItemOptions(); // تطبيق التعطيل فوراً على السيلكت الجديد بناءً على ما تم اختياره سابقاً
        }

        // حذف عضو
        if (e.target.classList.contains('remove-member')) {
            e.target.closest('.member-box').remove();
            refreshMemberOptions();
            updateTotal();
        }

        // حذف صنف معين من العضو
        if (e.target.classList.contains('remove-member-item')) {
            const memberBox = e.target.closest('.member-box');
            e.target.closest('.member-item').remove();
            refreshItemOptions(); // إعادة إتاحة الصنف المحذوف مجدداً في باقي السيلكتس لهذا العضو
            updateTotal();
        }
    });

    // مراقبة التغييرات في الاختيارات والكميات
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('member-admin-select')) {
            refreshMemberOptions();
        }

        if (e.target.classList.contains('member-item-select') || e.target.classList.contains('member-qty')) {
            const row = e.target.closest('.member-item');
            if (row) {
                const unitPrice = parseFloat(row.querySelector('.member-item-select option:checked')?.dataset.price || 0);
                const qty = parseFloat(row.querySelector('.member-qty').value || 1);
                const total = unitPrice * qty;

                row.querySelector('.member-price').value = total.toFixed(2);
                row.querySelector('.item-price').value = unitPrice;
            }

            if (e.target.classList.contains('member-item-select')) {
                refreshItemOptions(); // تصفية العناصر فور تغيير الاختيار الحالي
            }
            updateTotal();
        }
    });

    // إدارة منع تكرار الأعضاء الكلي
    function refreshMemberOptions() {
        const selectedAdmins = Array.from(
            document.querySelectorAll('.member-admin-select')
        ).map(s => s.value).filter(Boolean);

        document.querySelectorAll('.member-admin-select').forEach(currentSelect => {
            const currentValue = currentSelect.value;
            currentSelect.querySelectorAll('option').forEach(opt => {
                if (!opt.value) return;
                opt.disabled = selectedAdmins.includes(opt.value) && opt.value != currentValue;
            });
        });
    }

    // إدارة منع تكرار الأصناف للعضو الواحد
    function refreshItemOptions() {
        document.querySelectorAll('.member-box').forEach(memberBox => {
            // تجميع الأصناف المختارة داخل هذا الـ Box الخاص بالعضو الحالي فقط
            const selectedItems = Array.from(
                memberBox.querySelectorAll('.member-item-select')
            ).map(s => s.value).filter(Boolean);

            // تطبيق الحظر على الـ Selects التابعة لهذا العضو فقط لكي لا يتأثر الأعضاء الآخرين بأصناف بعضهم البعض
            memberBox.querySelectorAll('.member-item-select').forEach(currentSel => {
                const currentVal = currentSel.value;
                currentSel.querySelectorAll('option').forEach(opt => {
                    if (!opt.value) return;
                    opt.disabled = selectedItems.includes(opt.value) && opt.value != currentVal;
                });
            });
        });
    }

    // تحديث إجمالي العضو الفرعي
    function updateMemberTotal(memberBox) {
        let memberTotal = 0;
        memberBox.querySelectorAll('.member-item').forEach(item => {
            const price = parseFloat(item.querySelector('.member-price')?.value || 0);
            memberTotal += price;
        });

        let badge = memberBox.querySelector('.member-total-badge');
        if (!badge) {
            badge = document.createElement('span');
            badge.className = 'member-total-badge badge bg-success ms-2 fs-6';
            memberBox.querySelector('.d-flex h6').insertAdjacentElement('afterend', badge);
        }
        badge.textContent = `Total: ${memberTotal.toFixed(2)} EGP`;
    }

    // تحديث الإجمالي الكلي للفاتورة
    function updateTotal() {
        let totalPrice = 0;
        let totalItems = 0;

        document.querySelectorAll('.member-box').forEach(memberBox => {
            updateMemberTotal(memberBox);
            memberBox.querySelectorAll('.member-item').forEach(item => {
                totalPrice += parseFloat(item.querySelector('.member-price')?.value || 0);
                totalItems += parseFloat(item.querySelector('.member-qty')?.value || 0);
            });
        });

        const membersCount = document.querySelectorAll('.member-box').length;
        document.getElementById('totalAmount').textContent = totalPrice.toFixed(2);
        document.getElementById('hiddenTotalPrice').value  = totalPrice.toFixed(2);
        document.getElementById('hiddenTotalItems').value  = Math.round(totalItems);
        document.getElementById('hiddenMembersCount').value = membersCount;
    }

    // إضافة العضو الأول تلقائياً عند التحميل إذا كان هناك مطعم مختار مسبقاً
    window.addEventListener('load', () => {
        if (restaurantSelect.value) {
            document.getElementById('addMemberBtn').click();
        }
    });

    document.getElementById('orderForm').addEventListener('submit', updateTotal);
</script>
@endpush
