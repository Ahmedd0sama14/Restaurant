@extends('admin.dashbord.layouts')

@section('title', 'Members Management')

@section('content')

<div class="container-xxl py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-semibold">Members</h4>
            <p class="text-muted mb-0">Manage all registered members</p>
        </div>

        <a href="{{ route('admin.members.create') }}" class="btn btn-success">
            <i class="bx bx-plus"></i> Add New Member
        </a>

    </div>

    <x-alert />

    <!-- Table Card -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($members as $member)

                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>

                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-initial rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                             style="width:35px;height:35px;">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>

                                        <span>{{ $member->name }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-muted">{{ $member->email }}</span>
                                </td>

                                <td>
                                    <span class="badge bg-label-info">
                                        {{ $member->phone }}
                                    </span>
                                </td>

                                <td>
                                    <small class="text-muted">
                                        {{ $member->created_at->format('Y-m-d H:i') }}
                                    </small>
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('admin.members.edit', $member) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="bx bx-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.members.destroy', $member) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this member?')">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5">

                                    <div class="text-muted">
                                        <i class="bx bx-user-x fs-1 d-block mb-2"></i>
                                        No members found
                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
