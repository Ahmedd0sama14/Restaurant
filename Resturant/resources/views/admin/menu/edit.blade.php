@extends('admin.dashbord.layouts')

@section('title', 'Menu Edit ' )

@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h4>Edit Menu </h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.restaurants.menu.update', [$restaurant,$menu]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-form.input
                    name="item"
                    label="Item Name"
                    type="text"
                    value="{{ $menu->item }}"
                    required />

                <x-form.input
                    name="price"
                    label="Price (EGP)"
                    type="number"
                    value="{{ $menu->price }}"
                    required />

                <x-form.input
                    name="image"
                    label="Image"
                    type="file"
                    accept="image/*" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
