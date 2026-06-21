@extends('admin.dashbord.layouts')

@section('title', 'فاتورة الطلب - #' . $order->id)

@section('content')
    <!-- العناوين والأزرار الرئيسية -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="mb-0 fw-bold text-primary">
            <i class="bx bx-file"></i> فاتورة الطلب #{{ $order->id }}
        </h4>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-light border">
                <i class="bx bx-printer"></i> طباعة الفاتورة
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                <i class="bx bx-arrow-back"></i> رجوع
            </a>
        </div>
    </div>

    <x-alert />

    <!-- بيانات المطعم والطلب -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <!-- بيانات جهة إصدار الفاتورة -->
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-2">{{ $order->restaurant?->title }}</h5>
                    <p class="mb-1 text-muted">
                        <i class="bx bx-map-pin"></i> {{ $order->branch?->address ?? 'العنوان غير محدد' }}
                    </p>
                    @if($order->user)
                        <p class="mb-0 text-muted">
                            <i class="bx bx-user"></i> **العميل:** {{ $order->user->name }} | {{ $order->user->phone }}
                        </p>
                    @endif
                </div>
                <!-- تفاصيل الوقت والحالة -->
                <div class="col-md-6 text-md-end">
                    <h6 class="mb-1 fw-bold">رقم الطلب: #{{ $order->id }}</h6>
                    <p class="mb-1 text-muted">
                        <i class="bx bx-calendar"></i> {{ $order->created_at->format('d/m/Y h:i A') }}
                    </p>
                    <span class="badge bg-light-success text-success border border-success px-3 py-1">
                        {{ $order->status_text ?? 'مكتمل' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- جدول عناصر الفاتورة -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 fw-bold text-secondary">تفاصيل الأصناف</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40%">الصنف</th>
                            <th class="text-center" style="width: 15%">الكمية</th>
                            <th class="text-end" style="width: 20%">سعر الوحدة</th>
                            <th class="text-end" style="width: 25%">الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="fw-semibold text-dark">{{ $item['name'] }}</td>
                                <td class="text-center fw-bold text-secondary">{{ $item['quantity'] }}</td>
                                <td class="text-end">{{ number_format($item['price'], 2) }} ج.م</td>
                                <td class="text-end fw-bold">{{ number_format($item['total'], 2) }} ج.م</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- إجماليات الحساب -->
    <div class="row justify-content-end">
        <div class="col-md-5">
            <div class="card shadow-sm border-top border-4 border-success">
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="text-muted">إجمالي الأصناف:</td>
                            <td class="text-end fw-semibold">
                                {{ number_format($order->totalprice - ($order->services ?? 0), 2) }} ج.م
                            </td>
                        </tr>
                        @if ($order->services)
                            <tr>
                                <td class="text-warning fw-semibold">خدمات إضافية:</td>
                                <td class="text-end text-warning fw-semibold">
                                    + {{ number_format($order->services, 2) }} ج.م
                                </td>
                            </tr>
                        @endif
                        <tr class="border-top">
                            <td class="fs-5 fw-bold text-dark pt-3">الإجمالي الكلي:</td>
                            <td class="text-end fs-4 fw-bold text-success pt-2">
                                {{ number_format($order->totalprice, 2) }} ج.م
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
