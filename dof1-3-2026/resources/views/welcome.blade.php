<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>استيراد بيانات Excel</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    استيراد ملف Excel
                </div>

                <div class="card-body">
                    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">اختر ملف Excel</label>
                            <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            رفع الملف
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
