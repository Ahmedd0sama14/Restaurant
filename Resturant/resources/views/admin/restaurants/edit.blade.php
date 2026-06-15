@extends('admin.dashbord.layouts')

@section('title', 'Edit Restaurant')

@section('content')

<div class="container-xxl py-4">

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0 fw-semibold">Edit Restaurant</h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.restaurants.update', $restaurant) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="editRestaurantForm">

                @csrf
                @method('PUT')

                <!-- Restaurant Info -->
                <h5 class="mb-3 text-primary">Restaurant Information</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form.input name="title" label="Restaurant Title" value="{{ old('title', $restaurant->title) }}" required />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="hotline" label="Hotline" value="{{ old('hotline', $restaurant->hotline) }}" required />
                    </div>
                </div>

                <!-- Images (اختياري) -->
                <div class="mb-4">
                    <x-form.input
                        name="image[]"
                        label="New Images (Optional)"
                        type="file"
                        multiple
                        accept="image/*"
                        help="Leave empty if you don't want to change images" />
                </div>

                <hr class="my-4">

                <!-- Branches Management -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 text-primary">Branches</h5>
                    <button type="button" id="addBranchBtn" class="btn btn-success btn-sm">
                        <i class="bx bx-plus"></i> Add New Branch
                    </button>
                </div>

                <div id="branchesContainer">
                    @foreach($restaurant->branches as $index => $branch)
                        <div class="branch-item mb-4 p-3 border rounded" data-id="{{ $branch->id }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <x-form.input
                                        name="branches[{{ $index }}][phone]"
                                        label="Branch Phone"
                                        value="{{ old('branches.'.$index.'.phone', $branch->phone) }}"
                                        required />
                                </div>
                                <div class="col-md-6">
                                    <x-form.input
                                        name="branches[{{ $index }}][address]"
                                        label="Branch Address"
                                        value="{{ old('branches.'.$index.'.address', $branch->address) }}"
                                        required />
                                </div>
                            </div>
                            <input type="hidden" name="branches[{{ $index }}][id]" value="{{ $branch->id }}">

                            <button type="button" class="btn btn-danger btn-sm remove-branch mt-2">
                                <i class="bx bx-trash"></i> Remove Branch
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        Update Restaurant & Branches
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    let branchIndex = {{ $restaurant->branches->count() }};

    document.getElementById('addBranchBtn').addEventListener('click', function () {
        const container = document.getElementById('branchesContainer');

        const newBranch = `
            <div class="branch-item mb-4 p-3 border rounded">
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form.input
                            name="branches[${branchIndex}][phone]"
                            label="Branch Phone"
                            required />
                    </div>
                    <div class="col-md-6">
                        <x-form.input
                            name="branches[${branchIndex}][address]"
                            label="Branch Address"
                            required />
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-branch mt-2">
                    <i class="bx bx-trash"></i> Remove Branch
                </button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newBranch);
        branchIndex++;
    });

    // Remove branch
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-branch')) {
            if (document.querySelectorAll('.branch-item').length > 1) {
                e.target.closest('.branch-item').remove();
            } else {
                alert("يجب أن يكون هناك فرع واحد على الأقل!");
            }
        }
    });
</script>
@endpush
