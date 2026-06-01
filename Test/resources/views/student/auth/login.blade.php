@extends('student.auth.layouts')

@section('title', 'Login')

@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

            <!-- Login Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="mb-2">
                        Welcome Back 👋
                    </h4>

                    <p class="mb-4">
                        Please sign-in to your account
                    </p>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form
                        id="formAuthentication"
                        class="mb-3"
                        action="{{ route('student.login') }}"
                        method="POST"
                    >
                        @csrf

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
                                autofocus
                                required
                            />

                        </div>

                        <!-- Password -->
                        <div class="mb-3 form-password-toggle">

                            <div class="d-flex justify-content-between">

                                <label
                                    class="form-label"
                                    for="password"
                                >
                                    Password
                                </label>

                                <a href="#">
                                    <small>
                                        Forgot Password?
                                    </small>
                                </a>

                            </div>

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

                        <!-- Remember -->
                        <div class="mb-3">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                >

                                <label
                                    class="form-check-label"
                                    for="remember"
                                >
                                    Remember Me
                                </label>

                            </div>

                        </div>

                        <!-- Submit -->
                        <button class="btn btn-primary d-grid w-100">
                            Sign In
                        </button>

                    </form>

                    <!-- Register -->
                    <p class="text-center">

                        <span>
                            New on our platform?
                        </span>

                        <a href="{{ route('student.register') }}">
                            <span>Create an account</span>
                        </a>

                    </p>

                </div>
            </div>
            <!-- /Login Card -->

        </div>
    </div>
</div>

@endsection
