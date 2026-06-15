@extends('admin.dashbord.layouts')

@section('title', 'Admins Management')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <x-alert />

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Admins Management</h4>

            <a href="{{ route('admin.create') }}" class="btn btn-primary">
                Add Admin
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($admins as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $admin->name }}</td>

                                <td>{{ $admin->email }}</td>

                                <td>
                                    <span class="badge bg-label-primary">
                                        {{ $admin->role->name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $admin->created_at->format('Y-m-d') }}
                                </td>

                                <td>

                                    <a href="{{ route('admin.edit', $admin) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.delete', $admin) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this admin?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    No Admins Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $admins->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>

@endsection
