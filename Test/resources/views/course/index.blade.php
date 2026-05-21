@extends('layouts.layouts')

@section('title', 'Courses')

@section('content')

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Courses</h1>

            <a href="{{ route('courses.create') }}" class="btn btn-success">
                + Create Course
            </a>
        </div>

        {{-- Alerts --}}
        <x-alert type="success" />
        <x-alert type="error" />

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Teacher</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Final Price</th>
                                <th>Duration</th>
                                <th width="220">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($courses as $course)
                                <tr>

                                    {{-- ID --}}
                                    <td>{{ $course->id }}</td>

                                    {{-- Image --}}
                                    <td>
                                        <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/no-image.png') }}"
                                            alt="{{ $course->title }}" class="rounded" width="80" height="60"
                                            style="object-fit: cover;">
                                    </td>

                                    {{-- Title --}}
                                    <td>
                                        <h6 class="mb-1 fw-bold">
                                            {{ $course->title }}
                                        </h6>

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($course->description, 60) }}
                                        </small>
                                    </td>

                                    {{-- Teacher --}}
                                    <td>
                                        {{ $course->teacher->name ?? 'N/A' }}
                                    </td>

                                    {{-- Type --}}
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $course->courseType->title ?? 'N/A' }}
                                        </span>
                                    </td>

                                    {{-- Price --}}
                                    <td>
                                        ${{ number_format($course->price, 2) }}
                                    </td>

                                    {{-- Discount --}}
                                    <td>
                                        @if ($course->discount_type === \App\Enums\Course\CourseDiscountTypeEnum::Percentage)
                                            <span class="badge bg-danger">
                                                {{ $course->discount ?? 0 }}%
                                            </span>
                                        @elseif ($course->discount_type === \App\Enums\Course\CourseDiscountTypeEnum::Amount)
                                            <span class="badge bg-danger">
                                                ${{ number_format($course->discount ?? 0, 2) }}
                                            </span>
                                        @else
                                            <span class="text-muted">No discount</span>
                                        @endif
                                    </td>

                                    {{-- Final Price --}}
                                    <td class="fw-bold text-success">
                                        ${{ number_format($course->price_after_discount ?? $course->price, 2) }}
                                    </td>

                                    {{-- Duration --}}
                                    <td>
                                        {{ $course->duration }}
                                        {{ ucfirst($course->duration_type) }}
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('courses.show', $course->id) }}"
                                                class="btn btn-sm btn-primary">
                                                View
                                            </a>

                                            <a href="{{ route('courses.edit', $course->id) }}"
                                                class="btn btn-sm btn-warning text-white">
                                                Edit
                                            </a>

                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this course?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <p class="mb-0 text-muted">
                                            No courses found.
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
        <div class="mt-4 d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
