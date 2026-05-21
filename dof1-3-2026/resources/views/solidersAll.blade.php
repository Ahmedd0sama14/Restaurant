<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الجنود</title>

    <!-- Bootstrap 5 RTL محلي -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">


    <style>
        body {
            font-family: "Tajawal", sans-serif;
            background-color: #f8f9fa;
        }

        .table th,
        .table td {
            vertical-align: middle;
            white-space: nowrap; /* منع التفاف النصوص داخل الخلايا */
            padding: 0.35rem 0.5rem; /* تقليل الحشو لتوفير مساحة أكبر */
        }

        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto; /* شريط تمرير أفقي إذا أصبح الجدول عريض */
        }

        .input-group .form-control {
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .input-group .btn {
            border-radius: 0 0.25rem 0.25rem 0;
        }
    </style>
</head>

<body>
    <a href="{{ route('soliders.exportFill') }}"
   class="btn btn-success">
    استخراج التعبئة
</a>

    <div class="container my-5">

        <h2 class="mb-4 text-center">قائمة الجنود</h2>

        {{-- رسالة النجاح --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- نموذج البحث --}}
        <form method="GET" action="{{ route('soliders.showAll') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو الرقم العسكري"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">بحث</button>
            </div>
        </form>

        <div class="table-responsive shadow-sm bg-white rounded">
            <table class="table table-bordered table-striped text-center align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>الرقم الثلاثي</th>
                        <th>الرقم العسكري</th>
                        <th>الاسم</th>
                        <th>الرتبة</th>
                        <th>الرقم القومي</th>
                        <th>تاريخ التجنيد</th>
                        <th>تاريخ التسريح</th>
                        <th>المركز</th>
                        <th>المحافظة</th>
                        <th>الطول</th>
                        <th>الوزن</th>
                        <th>حجم الحذاء</th>
                        <th>مقاس الافارول</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soliders as $soldier)
                        <tr>
                            {{-- الرقم الثلاثي --}}
                            <td>
                                {{
                                    \App\Http\Controllers\solidersController::arabicNumbers($soldier->triple_1) . ' \ ' .
                                    \App\Http\Controllers\solidersController::arabicNumbers($soldier->triple_2) . ' \ ' .
                                    \App\Http\Controllers\solidersController::arabicNumbers($soldier->triple_3)
                                }}
                            </td>

                            {{-- الرقم العسكري --}}
                            <td>{{ \App\Http\Controllers\solidersController::arabicNumbers($soldier->military_number) }}</td>

                            {{-- الاسم --}}
                            <td class="text-start">{{ $soldier->name }}</td>

                            {{-- الرتبة --}}
                            <td>{{ $soldier->rank }}</td>

                            {{-- الرقم القومي --}}
                            <td>{{ \App\Http\Controllers\solidersController::arabicNumbers($soldier->national_id) }}</td>

                            {{-- تاريخ التجنيد --}}
                            <td>{{ \App\Http\Controllers\solidersController::arabicNumbers($soldier->recruitment_date) }}</td>

                            {{-- تاريخ التسريح --}}
                            <td>{{ \App\Http\Controllers\solidersController::arabicNumbers($soldier->release_date) }}</td>

                            {{-- المركز --}}
                            <td>{{ $soldier->center ?? '-' }}</td>

                            {{-- المحافظة --}}
                            <td>{{ $soldier->governorate ?? '-' }}</td>

                            {{-- الطول --}}
                            <td>{{ ($soldier->height ?? '-') }}</td>

                            {{-- الوزن --}}
                            <td>{{ ($soldier->weight ?? '-') }}</td>

                            {{-- حجم الحذاء --}}
                            <td>{{ ($soldier->boot_size ?? '-') }}</td>

                            {{-- مقاس الافارول --}}
                            <td>{{ ($soldier->overall_size ?? '-') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13">لا توجد بيانات للعرض</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $soliders->withQueryString()->links('pagination::bootstrap-5') }}
        </div>

    </div>
</body>

</html>
