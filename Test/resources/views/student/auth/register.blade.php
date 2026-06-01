@extends('student.auth.layouts')

@section('title', 'Register')

@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

            <div class="card">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="app-brand justify-content-center">

                        <a href="{{ url('/') }}"
                           class="app-brand-link gap-2">

                            <span class="app-brand-logo demo">

                                <img
                                    src="{{ asset('assets/img/logo.png') }}"
                                    width="40"
                                    alt="Logo"
                                >

                            </span>

                            <span class="app-brand-text demo text-body fw-bolder">
                                Student System
                            </span>

                        </a>

                    </div>

                    <!-- Title -->
                    <h4 class="mb-2">
                        Welcome 🚀
                    </h4>

                    <p class="mb-4">
                        Register your account easily
                    </p>

                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form
                        id="formAuthentication"
                        class="mb-3"
                        action="{{ route('student.register') }}"
                        method="POST"
                    >
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Enter your full name"
                                value="{{ old('name') }}"
                                required
                            />

                        </div>

                        <!-- Email -->
                        <div class="mb-3">

                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            />

                        </div>

                        <!-- Phone -->
                        <div class="mb-3">

                            <label for="phone" class="form-label">
                                Phone
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                placeholder="Enter your phone"
                                value="{{ old('phone') }}"
                                required
                            />

                        </div>

                        <!-- Password -->
                        <div class="mb-3 form-password-toggle">

                            <label class="form-label" for="password">
                                Password
                            </label>

                            <div class="input-group input-group-merge">

                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                />

                                <span class="input-group-text cursor-pointer">
                                    <i class="bx bx-hide"></i>
                                </span>

                            </div>

                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 form-password-toggle">

                            <label
                                class="form-label"
                                for="password_confirmation"
                            >
                                Confirm Password
                            </label>

                            <div class="input-group input-group-merge">

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    required
                                />

                            </div>

                        </div>

                        <!-- Submit -->
                        <button class="btn btn-primary d-grid w-100">
                            Sign Up
                        </button>

                    </form>

                    <!-- Login -->
                    <p class="text-center">

                        <span>
                            Already have an account?
                        </span>

                        <a href="{{ route('student.login') }}">
                            <span>Sign in instead</span>
                        </a>

                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
