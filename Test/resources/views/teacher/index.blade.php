<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
    @forelse ($teachers as $teacher)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $teacher->name }}</h5>
                <p class="card-text">Email: {{ $teacher->email }}</p>
                <p class="card-text">Phone: {{ $teacher->phone }}</p>
                <p class="card-text">Balance: {{ $teacher->balance }}</p>
            </div>
        </div>
    @empty
        <p>No teachers found.</p>
    @endforelse
</body>

</html>
