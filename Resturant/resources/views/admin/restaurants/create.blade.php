@extends('admin.dashbord.layouts')

@section('title', 'Create Restaurant')

@section('content')

<div class="container-xxl py-4">

    <div class="card border-0 shadow-sm">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-semibold">Create New Restaurant</h4>
                <small class="text-muted">Add restaurant details and branches</small>
            </div>

            <i class="bx bx-store fs-2 text-primary"></i>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.restaurants.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="restaurantForm">

                @csrf

                <!-- Restaurant Info -->
                <h5 class="text-primary mb-3">Restaurant Information</h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <x-form.input
                            name="title"
                            label="Restaurant Title"
                            required />
                    </div>

                    <div class="col-md-6">
                        <x-form.input
                            name="hotline"
                            label="Hotline"
                            type="text"
                            required />
                    </div>
                </div>

                <!-- Images -->
                <div class="mt-4">
                    <x-form.input
                        name="image[]"
                        label="Restaurant Images"
                        type="file"
                        multiple
                        accept="image/*"
                        help="You can upload multiple images (Max 2MB each)" />
                </div>

                <hr class="my-4">

                <!-- Branches -->
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="mb-0 text-primary">Branches</h5>
                        <small class="text-muted">Add multiple branches if needed</small>
                    </div>

                    <button type="button"
                            id="addBranchBtn"
                            class="btn btn-success btn-sm">
                        <i class="bx bx-plus"></i>
                        Add Branch
                    </button>

                </div>

                <!-- Branches Container -->
                <div id="branchesContainer">

                    <!-- First Branch -->
                    <div class="branch-item card border mb-3 shadow-sm">

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Branch Phone
                                    </label>

                                    <input type="text"
                                           name="branches[0][phone]"
                                           class="form-control"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Branch Address
                                    </label>

                                    <input type="text"
                                           name="branches[0][address]"
                                           class="form-control"
                                           required>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-4 text-end">
                    <button type="submit"
                            class="btn btn-primary btn-lg px-5">
                        Create Restaurant
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    let branchIndex = 1;

    const addBranchBtn = document.getElementById('addBranchBtn');
    const branchesContainer = document.getElementById('branchesContainer');

    addBranchBtn.addEventListener('click', function () {

        const branchHtml = `
            <div class="branch-item card border mb-3 shadow-sm">

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">
                                Branch Phone
                            </label>

                            <input type="text"
                                   name="branches[${branchIndex}][phone]"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Branch Address
                            </label>

                            <input type="text"
                                   name="branches[${branchIndex}][address]"
                                   class="form-control"
                                   required>
                        </div>

                    </div>

                    <div class="text-end mt-3">

                        <button type="button"
                                class="btn btn-danger btn-sm remove-branch">
                            <i class="bx bx-trash"></i>
                            Remove Branch
                        </button>

                    </div>

                </div>

            </div>
        `;

        branchesContainer.insertAdjacentHTML('beforeend', branchHtml);

        branchIndex++;
    });

    branchesContainer.addEventListener('click', function (e) {

        const removeBtn = e.target.closest('.remove-branch');

        if (removeBtn) {
            removeBtn.closest('.branch-item').remove();
        }

    });

});
</script>
@endpush
