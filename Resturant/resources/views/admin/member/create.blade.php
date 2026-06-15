@extends('admin.dashbord.layouts')
@section('title', 'Create New Member')

@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h4>Create New Member</h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf

                <x-form.input
                    name="name"
                    label="Member Name"
                    value="{{ old('name') }}"
                    required
                />

                <x-form.input
                    name="phone"
                    label="Phone Number"
                    value="{{ old('phone') }}"
                    required
                />

                <x-form.input
                    name="email"
                    label="Email Address"
                    value="{{ old('email') }}"
                    required
                />

                <x-form.input
                    name="password"
                    label="Password"
                    type="password"
                    required
                />

                <x-form.input
                    name="password_confirmation"
                    label="Confirm Password"
                    type="password"
                    required
                />
                <div class="d-flex justify-content-end mt-4">

                            <a href="{{ route('admin.members.store') }}"
                               class="btn btn-outline-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save"></i>
                                Create Member
                            </button>

                        </div>

            </form>

        </div>
    </div>
</div>
@endsection
