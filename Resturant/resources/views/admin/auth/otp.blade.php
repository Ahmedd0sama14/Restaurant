@extends('student.auth.layouts')

@section('title', 'OTP Verification')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- OTP Card -->
                <div class="card">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="app-brand justify-content-center">

                            <a href="{{ url('/') }}" class="app-brand-link gap-2">

                               

                                <span class="app-brand-text demo text-body fw-bolder">
                                    Student System
                                </span>

                            </a>

                        </div>

                        <h4 class="mb-2 text-center">
                            OTP Verification 🔐
                        </h4>

                        <p class="mb-4 text-center">
                            Enter the verification code sent to your email
                        </p>

                        {{-- Success --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- OTP Form -->
                        <form action="{{ route('student.otp') }}" method="POST" class="mb-3">
                            @csrf

                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="mb-3">
                                <label class="form-label">OTP Code</label>

                                <input type="text" name="otp" class="form-control text-center"
                                    placeholder="Enter OTP" maxlength="6" required autofocus>
                            </div>

                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Verify OTP
                            </button>
                        </form>

                        <!-- Resend OTP -->
                        <div class="text-center">

                            <form action="{{ route('student.resend-otp') }}" method="POST">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">


                                <button type="submit" class="btn btn-link p-0">
                                    Didn’t receive the code? Resend OTP
                                </button>

                            </form>

                        </div>

                    </div>
                </div>
                <!-- /OTP Card -->

            </div>
        </div>
    </div>

@endsection
