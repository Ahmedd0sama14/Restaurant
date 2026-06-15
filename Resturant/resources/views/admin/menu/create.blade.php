@extends('admin.dashbord.layouts')

@section('title', 'Create New Menu Item - ' . $restaurant->title)

@section('content')

<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <div>
                <h4 class="mb-0">Create Menu Item</h4>
                <small class="text-muted">{{ $restaurant->title }}</small>
            </div>
        </div>
        <div class="card-body">
            <x-alert />
            <form action="{{ route('admin.restaurants.menu.store', $restaurant) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                <x-form.input
                    name="item"
                    label="Item Name"
                    placeholder="Enter menu item name"
                    required
                />

                <!-- Price -->
                <x-form.input
                    name="price"
                    label="Price (EGP)"
                    type="number"
                    placeholder="0.00"
                    required
                />
                <x-form.input
                    name="image"
                    label="Item Image"
                    type="file"
                    accept="image/jpeg,image/png,image/jpg"
                    help="Recommended size: 600x600 px (JPG, PNG)"
                />
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    Save Menu Item
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
