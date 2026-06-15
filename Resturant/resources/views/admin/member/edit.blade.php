@extends('admin.dashbord.layouts')

@section('title', 'Edit Member')

@section('content')

<div class="container-xxl">
    <div class="card">

        <div class="card-header">
            <h4>Edit member</h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.update', $member) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form.input
                    name="name"
                    label="Admin Name"
                    value="{{ old('name', $member->name) }}"
                    required
                />

                <x-form.input
                    name="phone"
                    label="Phone Number"
                    value="{{ old('phone', $member->phone) }}"
                    required
                />

                <x-form.input
                    name="email"
                    label="Email Address"
                    type="email"
                    value="{{ old('email', $member->email) }}"
                    required
                />

                <x-form.input
                    name="password"
                    label="New Password"
                    type="password"
                />

                <x-form.input
                    name="password_confirmation"
                    label="Confirm Password"
                    type="password"
                />
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    Update MEMBER
                </button>

            </form>

        </div>

    </div>
</div>

@endsection
