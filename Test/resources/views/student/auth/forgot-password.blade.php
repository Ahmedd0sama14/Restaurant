@extends('student.auth.layouts')

@section('title', 'Forgot Password')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">

            <div class="card">
                <div class="card-body">

                    <div class="app-brand justify-content-center">
                        <a href="{{ route('student.login') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder">
                                Sneat
                            </span>
                        </a>
                    </div>

                    <h4 class="mb-2">Forgot Password? 🔒</h4>

                    <p class="mb-4">
                        Enter your email and we'll send you instructions to reset your password
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary d-grid w-100">
                            Send Reset Link
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('student.login') }}">
                            Back to login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
