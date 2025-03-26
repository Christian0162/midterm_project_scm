@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Colleges</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    Add New College
                </button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><a href="{{ route('colleges.index', ['sort' => 'CollegeID', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">ID</a></th>
                                <th><a href="{{ route('colleges.index', ['sort' => 'CollegeName', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">College Name</a></th>
                                <th><a href="{{ route('colleges.index', ['sort' => 'CollegeCode', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">College Code</a></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($colleges as $college)
                                <tr>
                                    <td>{{ $college->CollegeID }}</td>
                                    <td>{{ $college->CollegeName }}</td>
                                    <td>{{ $college->CollegeCode }}</td>
                                    <td class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view{{ $college->CollegeID }}">View</button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $college->CollegeID }}">Edit</button>
                                        <form action="{{ route('colleges.destroy', $college->CollegeID) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No colleges found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $colleges->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
