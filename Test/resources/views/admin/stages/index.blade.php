@extends('layouts.layouts')

@section('title', 'Stages')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Stages</h5>

                <a href="{{ route('EducationTypes.Stages.create', $EducationType) }}"
                   class="btn btn-primary btn-sm">
                    Add Stage
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($stages as $stage)
                            <tr>
                                <td>{{ $stage->id }}</td>

                                <td>
                                    {{ $stage->title }}
                                </td>

                                <td>
                                    {{ $stage->type->label() }}
                                </td>

                                <td>
                                    <a href="{{ route('EducationTypes.Stages.show', ['EducationType' => $EducationType, 'Stage' => $stage]) }}">View</a>
                                    <a href="{{ route('EducationTypes.Stages.edit', ['EducationType' => $EducationType, 'Stage' => $stage]) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('EducationTypes.Stages.destroy', ['EducationType' => $EducationType, 'Stage' => $stage]) }}"
                                          method="POST"
                                          style="display:inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No Stages Found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
