@extends('admin.dashbord.layouts')

@section('title', 'Create Branch ')

@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h4>Create Branch For {{ $restaurant->title }}</h4>
        </div>

        <div class="card-body">

            <x-alert />

            <form action="{{ route('admin.restaurants.branch.store', $restaurant) }}" method="POST">
                @csrf
                <x-form.input
                    name="phone"
                    label="phone"
                    required />

                <x-form.input
                    name="address"
                    label="address"
                    type="text"
                    required />
                     <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Create Branch
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection
