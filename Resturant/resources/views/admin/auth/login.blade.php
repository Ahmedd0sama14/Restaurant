@extends('admin.auth.layouts')

@section('title', 'Login')

@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

            <div class="card">
                <div class="card-body">

                    <h4 class="mb-2">
                        Welcome Back 👋
                    </h4>

                    <p class="mb-4">
                        Please sign in to your admin account
                    </p>

                    <x-alert />

                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <x-form.input
                                name="email"
                                label="Email"
                                type="email"
                                required />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <div class="input-group input-group-merge">

                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="••••••••"
                                    required />
                                <span class="input-group-text cursor-pointer toggle-password">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>

                        </div>

                        <!-- Remember -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-100">
                            Sign In
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
