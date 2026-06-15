@extends('admin.dashbord.layouts')

@section('title', 'Branche Edit ' )

@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h4>Edit Branch </h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.restaurants.branch.update', [$restaurant,$branch]) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form.input
                    name="phone"
                    label="phone"
                    type="text"
                    value="{{ $branch->phone }}"
                    required />

                <x-form.input
                    name="address"
                    label="address"
                    type="text"
                    value="{{ $branch->address }}"
                    required />

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
