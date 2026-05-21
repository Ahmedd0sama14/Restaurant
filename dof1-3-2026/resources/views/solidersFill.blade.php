<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>دفعة التسريح</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-slate-100 to-slate-200 font-sans">

    <form method="POST" action="{{ route('soliders.export') }}" class="mt-6 text-left">
        @csrf
        <input type="hidden" name="release_date" value="{{ request('release_date') }}">
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg transition">
            استخراج ملف التعبئة
        </button>
    </form>


    <div class="max-w-6xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-xl font-bold text-slate-700 mb-6 border-b pb-3">
            اختيار دفعة التسريح
        </h3>

        <!-- form -->
        <form method="GET" action="" class="flex flex-wrap items-end gap-4 bg-slate-50 p-4 rounded-lg">
            <div>
                <label class="block mb-1 font-semibold text-slate-600">
                    تاريخ التسريح
                </label>
                <input type="date" name="release_date" value="{{ request('release_date') }}" required
                    class="border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                عرض المسرحين
            </button>
        </form>

        @if (!empty($soliders) && count($soliders) > 0)
            <div class="mt-8">

                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-bold text-slate-700">
                        بيانات المسرحين
                    </h4>
                    <span class="text-sm text-slate-600">
                        العدد: <strong>{{ count($soliders) }}</strong>
                    </span>
                </div>

                <!-- table -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-slate-200 rounded-lg overflow-hidden">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-4 py-3 border">#</th>
                                <th class="px-4 py-3 border">الاسم</th>
                                <th class="px-4 py-3 border">الرقم العسكري</th>
                                <th class="px-4 py-3 border">تاريخ التسريح</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soliders as $solider)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-2 border text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $solider->name }}
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $solider->military_number }}
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ \Carbon\Carbon::parse($solider->release_date)->format('d / m / Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- actions -->

            </div>
        @endif

    </div>

</body>

</html>
