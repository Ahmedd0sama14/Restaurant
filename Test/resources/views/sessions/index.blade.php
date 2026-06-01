@extends('layouts.layouts')

@section('title', 'Sessions')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold text-primary">
            Sessions List
        </h1>

        <a href="{{ route('sessions.create') }}"
           class="btn btn-primary rounded-pill px-4">
            + Add Session
        </a>

    </div>

    {{-- Sessions --}}
    <div class="row g-4">

        @forelse ($sessions as $session)

            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">

                    {{-- File Preview --}}
                    @if ($session->file)

                        {{-- Video --}}
                        @if ($session->session_type === \App\Enums\Session\SessionTypeEnum::video)

                            <video controls
                                   class="w-100"
                                   style="height: 220px; object-fit: cover;">

                                <source src="{{ asset('storage/' . $session->file) }}">

                                Your browser does not support the video tag.

                            </video>

                        {{-- Audio --}}
                        @elseif($session->session_type === \App\Enums\Session\SessionTypeEnum::audio)

                            <div class="bg-light d-flex align-items-center justify-content-center flex-column"
                                 style="height: 220px;">

                                <audio controls class="w-75">

                                    <source src="{{ asset('storage/' . $session->file) }}">

                                    Your browser does not support the audio element.

                                </audio>

                            </div>

                        @endif

                    @else

                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 220px;">

                            <span class="text-muted">
                                No File
                            </span>

                        </div>

                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">

                        {{-- Session Type --}}
                        <span class="badge bg-primary mb-3 w-auto px-3 py-2">

                            {{ $session->session_type->label() }}

                        </span>

                        {{-- Buttons --}}
                        <div class="mt-auto">

                            <div class="d-flex gap-2">

                                {{-- View --}}
                                <a href="{{ route('sessions.show', $session->id) }}"
                                   class="btn btn-dark w-100 rounded-pill">

                                    View

                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('sessions.edit', $session->id) }}"
                                   class="btn btn-warning w-100 rounded-pill text-white">

                                    Edit

                                </a>

                            </div>

                            {{-- Delete --}}
                            <form action="{{ route('sessions.destroy', $session->id) }}"
                                  method="POST"
                                  class="mt-2">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger w-100 rounded-pill"
                                        onclick="return confirm('Are you sure you want to delete this session?')">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info text-center rounded-4">

                    No sessions found.

                </div>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-4">

        {{ $sessions->links('pagination::bootstrap-5') }}

    </div>

</div>

@endsection
