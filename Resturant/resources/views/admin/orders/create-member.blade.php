@extends('admin.dashbord.layouts')

@section('title', 'Add Members To Order')

@section('content')
    <div class="container-xxl py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-semibold">
                    <i class="bx bx-user-plus"></i> Add Members To Order #{{ $order->id }}
                </h4>
                <span class="badge bg-primary fs-6">
                    Restaurant: {{ $order->restaurant->title }}
                </span>
            </div>

            <div class="card-body">
                <x-alert />

                {{-- الـ Action هنا يوجه لراوت حفظ الأعضاء الخاص بك --}}
                <form action="{{ route('order.members.store', $order) }}" method="POST" id="orderForm">
                    @csrf

                    <h5 class="mb-3 fw-semibold text-muted">Order Members</h5>
                    <div id="membersContainer">
                        {{-- سيتم توليد الأعضاء هنا ديناميكياً بواسطة الجافاسكربت --}}
                    </div>

                    <button type="button" id="addMemberBtn" class="btn btn-success mb-4 shadow-sm">
                        <i class="bx bx-plus"></i> Add New Member
                    </button>

                    <hr class="my-4">

                    <input type="hidden" name="totalprice" id="hiddenTotalPrice" value="0">
                    <input type="hidden" name="number_of_items" id="hiddenTotalItems" value="0">
                    <input type="hidden" name="number_of_members" id="hiddenMembersCount" value="0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

                        <div class="text-end">
                            <h4 class="mb-0">Total: <span id="totalAmount" class="text-success fw-bold">0.00</span> EGP</h4>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                            Save Members
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let memberIndex = 0;

    // جلب قائمة المنيو الخاصة بالمطعم من السيرفر مباشرة وتحويلها لـ JSON للاستخدام في الجافاسكربت
    const restaurantMenus = {!! json_encode($order->restaurant->menus) !!};

    // تجهيز خيارات قائمة الطعام مسبقاً
    let menuOptions = '<option value="">Select Item</option>';
    restaurantMenus.forEach(menu => {
        menuOptions += `
            <option value="${menu.id}" data-price="${menu.price}">
                ${menu.item ?? menu.title} (${parseFloat(menu.price).toFixed(2)} EGP)
            </option>`;
    });

    // إضافة عضو جديد
    document.getElementById('addMemberBtn').addEventListener('click', function() {
        const html = `
        <div class="member-box border p-3 mb-4 rounded shadow-sm bg-white" data-index="${memberIndex}">
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <h6 class="mb-0 fw-bold text-secondary">Member ${memberIndex + 1}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm remove-member">
                    <i class="bx bx-trash"></i> Remove Member
                </button>
            </div>

            <select name="members[${memberIndex}][member_id]" class="form-select mb-3 member-admin-select" required>
                <option value="">Select Member</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <div class="member-items" data-item-index="1">
                <div class="row g-2 mb-2 member-item align-items-center">
                    <div class="col-md-5">
                        <label class="form-label d-md-none">Item</label>
                        <select name="members[${memberIndex}][items][0][menu_id]"
                                class="form-select member-item-select" required>
                            ${menuOptions}
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label d-md-none">Qty</label>
                        <input type="number" name="members[${memberIndex}][items][0][quantity]"
                               value="1" min="1" class="form-control member-qty" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label d-md-none">Total Price</label>
                        <input type="text" class="form-control member-price bg-light" readonly value="0.00">
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-danger remove-member-item w-100">×</button>
                    </div>
                    <input type="hidden" name="members[${memberIndex}][items][0][unit_price]"
                           class="item-price" value="0">
                </div>
            </div>

            <button type="button" class="btn btn-outline-success btn-sm add-member-item mt-2">
                <i class="bx bx-plus"></i> Add Another Item
            </button>
        </div>`;

        document.getElementById('membersContainer').insertAdjacentHTML('beforeend', html);

        refreshMemberOptions();
        refreshItemOptions();
        memberIndex++;
        updateTotal();
    });

    // تفويض الأحداث للعمليات داخل الصناديق الديناميكية
    document.addEventListener('click', function(e) {
        // إضافة صنف جديد لنفس العضو
        if (e.target.classList.contains('add-member-item') || e.target.closest('.add-member-item')) {
            const button = e.target.classList.contains('add-member-item') ? e.target : e.target.closest('.add-member-item');
            const memberBox = button.closest('.member-box');
            const memberIdx = memberBox.dataset.index;
            let itemIdx = parseInt(memberBox.querySelector('.member-items').dataset.itemIndex || 1);

            const html = `
            <div class="row g-2 mb-2 member-item align-items-center">
                <div class="col-md-5">
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
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger remove-member-item w-100">×</button>
                </div>
                <input type="hidden" name="members[${memberIdx}][items][${itemIdx}][unit_price]"
                       class="item-price" value="0">
            </div>`;

            memberBox.querySelector('.member-items').insertAdjacentHTML('beforeend', html);
            memberBox.querySelector('.member-items').dataset.itemIndex = itemIdx + 1;

            refreshItemOptions();
        }

        // حذف عضو
        if (e.target.classList.contains('remove-member') || e.target.closest('.remove-member')) {
            const button = e.target.classList.contains('remove-member') ? e.target : e.target.closest('.remove-member');
            button.closest('.member-box').remove();
            refreshMemberOptions();
            updateTotal();
        }

        // حذف صنف من العضو
        if (e.target.classList.contains('remove-member-item')) {
            const memberBox = e.target.closest('.member-box');
            e.target.closest('.member-item').remove();
            refreshItemOptions();
            updateTotal();
        }
    });

    // مراقبة التغييرات في الاختيارات والكميات وحساب الحسابات
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
                refreshItemOptions();
            }
            updateTotal();
        }
    });

    // منع تكرار الأعضاء الكلي
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

    // منع تكرار الأصناف للعضو الواحد
    function refreshItemOptions() {
        document.querySelectorAll('.member-box').forEach(memberBox => {
            const selectedItems = Array.from(
                memberBox.querySelectorAll('.member-item-select')
            ).map(s => s.value).filter(Boolean);

            memberBox.querySelectorAll('.member-item-select').forEach(currentSel => {
                const currentVal = currentSel.value;
                currentSel.querySelectorAll('option').forEach(opt => {
                    if (!opt.value) return;
                    opt.disabled = selectedItems.includes(opt.value) && opt.value != currentVal;
                });
            });
        });
    }

    // تحديث إجمالي العضو الفرعي (يظهر بجوار عنوان العضو)
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

    // تحديث الإجمالي الكلي
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

    // إضافة العضو الأول تلقائياً عند تحميل الصفحة
    window.addEventListener('load', () => {
        document.getElementById('addMemberBtn').click();
    });

    document.getElementById('orderForm').addEventListener('submit', updateTotal);
</script>
@endpush
