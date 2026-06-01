@extends('layouts.layouts')

@section('title', 'Session Details')

@section('content')
    <div class="container mt-5">
        <h1>Session Details</h1>

        <div class="card">
            <div class="card-body">

                <p><strong>ID:</strong> {{ $session->id }}</p>

                <p><strong>Session Type:</strong>
                    {{ $session->session_type->label() }}
                </p>

                @if ($session->file)

                    {{-- Video --}}
                    @if ($session->session_type === \App\Enums\Session\SessionTypeEnum::video)
                        <video controls class="w-100" style="height: 220px; object-fit: cover;">
                            <source src="{{ asset('storage/' . $session->file) }}">
                            Your browser does not support the video tag.
                        </video>

                        {{-- Audio --}}
                    @elseif ($session->session_type === \App\Enums\Session\SessionTypeEnum::audio)
                        <div class="bg-light d-flex align-items-center justify-content-center flex-column"
                            style="height: 220px;">

                            <audio controls class="w-75">
                                <source src="{{ asset('storage/' . $session->file) }}">
                                Your browser does not support the audio element.
                            </audio>

                        </div>
                    @endif
                @else
                    <p class="text-muted">No media file available for this session.</p>

                @endif

            </div>
        </div>

        <a href="{{ route('sessions.index') }}" class="btn btn-secondary mt-3">
            Back to List
        </a>
    </div>
@endsection
