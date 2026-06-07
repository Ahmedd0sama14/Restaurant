@extends('layouts.layouts')
@section('title', 'Subscriptions')
@section('content')
    <h1>Subscriptions</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">userName</th>
                <th scope="col">Teacher</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscriptions as $subscription)
                <tr>
                    <th scope="row">{{ $subscription->id }}</th>
                    <td>{{ $subscription->user->name }}</td>
                    <td>{{ $subscription->teacher->name }}</td>
                    <td>{{ $subscription->Type->name }}</td>
                    <td>{{ $subscription->price }}</td>
                    <td>{{ $subscription->status->name }}</td>
                    <td>
                        <a href="{{ route('subscriptions.show', $subscription->id) }}" class="btn btn-primary">View</a>
                        <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Subscriptions Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $subscriptions->links('pagination::bootstrap-5') }}
@endsection
