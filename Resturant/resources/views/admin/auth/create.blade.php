@extends('admin.dashbord.layouts')

@section('title', 'Create New Admin')

@section('content')

<div class="container-xxl py-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">
                    <h4 class="mb-1 fw-semibold">
                        <i class="bx bx-user-plus text-primary"></i>
                        Create New Admin
                    </h4>

                    <small class="text-muted">
                        Fill in the information below to create a new administrator account.
                    </small>
                </div>

                <div class="card-body">

                    <x-alert />

                    <form action="{{ route('admin.store') }}" method="POST" id="createUserForm">
                        @csrf

                        <!-- Personal Info -->
                        <h6 class="text-primary mb-3">
                            <i class="bx bx-user"></i>
                            Personal Information
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <x-form.input name="name" label="Full Name" required />
                            </div>

                            <div class="col-md-6">
                                <x-form.input name="phone" label="Phone Number" required />
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-12">
                                <x-form.input name="email" label="Email Address" type="email" required />
                            </div>
                        </div>

                        <!-- Security Info -->
                        <hr class="my-4">

                        <h6 class="text-primary mb-3">
                            <i class="bx bx-lock-alt"></i>
                            Security Information
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <x-form.input name="password" label="Password" type="password" required />
                            </div>

                            <div class="col-md-6">
                                <x-form.input name="password_confirmation" label="Confirm Password" type="password" required />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end mt-4">

                            <a href="{{ route('admin.store') }}"
                               class="btn btn-outline-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save"></i>
                                Create Admin
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById('createUserForm').addEventListener('submit', function(e) {

    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
    }
});
</script>
@endpush
