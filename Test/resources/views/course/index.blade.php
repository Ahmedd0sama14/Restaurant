@extends('layouts.layouts')

@section('title', 'Courses')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Courses
            </h1>

            <p class="text-muted mb-0">
                Manage all available courses
            </p>
        </div>

        <a href="{{ route('courses.create') }}" class="btn btn-success shadow-sm">
            + Create Course
        </a>

    </div>


    {{-- Courses Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    {{-- Table Head --}}
                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Course</th>
                            <th>Teacher</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Final Price</th>
                            <th>Duration</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>

                    {{-- Table Body --}}
                    <tbody>

                        @forelse ($courses as $course)

                            <tr>

                                {{-- ID --}}
                                <td class="fw-semibold">
                                    {{ $course->id }}
                                </td>

                                {{-- Image --}}
                                <td>

                                    <img
                                        src="{{ $course->image
                                                ? asset('storage/' . $course->image)
                                                : asset('images/no-image.png') }}"
                                        alt="{{ $course->title }}"
                                        class="rounded shadow-sm"
                                        width="90"
                                        height="65"
                                        style="object-fit: cover;">

                                </td>

                                {{-- Course Info --}}
                                <td>

                                    <h6 class="fw-bold mb-1">
                                        {{ $course->title }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($course->description, 70) }}
                                    </small>

                                </td>

                                {{-- Teacher --}}
                                <td>

                                    <span class="fw-medium">
                                        {{ $course->teacher?->name ?? 'N/A' }}
                                    </span>

                                </td>

                                {{-- Course Type --}}
                                <td>

                                    <span class="badge bg-primary">
                                        {{ $course->courseType?->title ?? 'N/A' }}
                                    </span>

                                </td>

                                {{-- Original Price --}}
                                <td>

                                    <span class="fw-semibold">
                                        ${{ number_format($course->price, 2) }}
                                    </span>

                                </td>

                                {{-- Discount --}}
                                <td>

                                    @if ($course->discount && $course->discount_type)

                                        <span class="badge bg-danger">

                                            {{ $course->discount }}

                                            @if ($course->discount_type->label() === 'Percentage')
                                                %
                                            @endif

                                            {{ $course->discount_type->label() }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            No discount
                                        </span>

                                    @endif

                                </td>

                                {{-- Final Price --}}
                                <td>

                                    <span class="fw-bold text-success">
                                        ${{ number_format($course->price_after_discount ?? $course->price, 2) }}
                                    </span>

                                </td>

                                {{-- Duration --}}
                                <td>

                                    <span class="badge bg-light text-dark border">

                                        {{ $course->duration }}
                                        {{ $course->duration_type->label() }}

                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex gap-2">

                                        {{-- Show --}}
                                        <a href="{{ route('courses.show', ['course' => $course]) }}"
                                           class="btn btn-sm btn-primary">

                                            View

                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('courses.edit', ['course' => $course]) }}"
                                           class="btn btn-sm btn-warning text-white">

                                            Edit

                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('courses.destroy', ['course' => $course]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this course?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- Empty State --}}
                            <tr>

                                <td colspan="10" class="text-center py-5">

                                    <h5 class="fw-bold">
                                        No Courses Found
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Start by creating your first course.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">

        {{ $courses->links('pagination::bootstrap-5') }}

    </div>

</div>

@endsection
