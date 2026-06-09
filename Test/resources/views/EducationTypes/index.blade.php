@extends('layouts.layouts')
@section('title', ' Educations Type')
@section('content')
   <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold text-primary">
Educations Type
        </h1>

        <a href="{{ route('education-types.create') }}"
           class="btn btn-primary rounded-pill px-4">
            + Add EducationType
        </a>

    </div>
    <h1>Educations Type</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Stages</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($educationTypes as $educationType)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $educationType->title}}</td>
                    <td> <a href="{{ route('EducationTypes.Stages.index', ['EducationType' => $educationType] ) }}" class="btn btn-primary">ShowStages</a></td>
                    <td>
                        <a href="{{ route('education-types.edit', ['education_type' => $educationType] ) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('education-types.destroy', ['education_type' =>$educationType ]) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Education Types Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
