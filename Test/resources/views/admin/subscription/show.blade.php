@extends('layouts.layouts')
@section('title', 'Subscription Details')

@section('content')
    <h1>Subscription Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $subscription->id }}</p>
            <p><strong>Name:</strong> {{ $subscription->user->name }}</p>
            <p><strong>Price:</strong> {{ $subscription->price }}</p>
            <p><strong>Type:</strong> {{ $subscription->Type->name }}</p>
            <p><strong>Teacher:</strong> {{ $subscription->teacher->name }}</p>

            <img src="{{ asset('storage/' . $subscription->image) }}" alt="Subscription Image" class="img-fluid mb-3"
                sizes="90px">

            <p><strong>Created At:</strong> {{ $subscription->created_at }}</p>

            @if ($subscription->status->value === 1)
                <div class="alert alert-success">
                    This subscription has been accepted and cannot be modified.
                </div>
            @else
                <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="status" class="form-label">
                            <strong>Status</strong>
                        </label>

                        <select name="status" id="status" class="form-control">
                            <option value="0"
                                {{ $subscription->status->value === 0 ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="1"
                                {{ $subscription->status->value === 1 ? 'selected' : '' }}>
                                Accepted
                            </option>

                            <option value="2"
                                {{ $subscription->status->value === 2 ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update Status
                    </button>
                </form>
            @endif
        </div>
    </div>

    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary mt-3">
        Back to List
    </a>
@endsection
