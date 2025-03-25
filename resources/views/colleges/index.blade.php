@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Colleges</h2>
                {{-- add --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    Add New College
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New College</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('colleges.store') }}" method="POST">
                        <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="CollegeName" class="form-label">College Name</label>
                                    <input type="text" class="form-control @error('CollegeName') is-invalid @enderror" id="CollegeName" name="CollegeName" value="{{ old('CollegeName') }}" required>
                                    @error('CollegeName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="CollegeCode" class="form-label">College Code</label>
                                    <input type="text" class="form-control @error('CollegeCode') is-invalid @enderror" id="CollegeCode" name="CollegeCode" value="{{ old('CollegeCode') }}" required>
                                    @error('CollegeCode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save College</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>College Name</th>
                                <th>College Code</th>
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
                                        {{-- view --}}
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view">
                                            View
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width: 150px;">College ID:</th>
                                                            <td>{{ $college->CollegeID }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>College Name:</th>
                                                            <td>{{ $college->CollegeName }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>College Code:</th>
                                                            <td>{{ $college->CollegeCode }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status:</th>
                                                            <td>{{ $college->IsActive ? 'Active' : 'Inactive' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                        {{-- edit --}}
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit">
                                            Edit
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('colleges.update', $college->CollegeID) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="CollegeName" class="form-label">College Name</label>
                                                            <input type="text" class="form-control @error('CollegeName') is-invalid @enderror" id="CollegeName" name="CollegeName" value="{{ old('CollegeName', $college->CollegeName) }}" required>
                                                            @error('CollegeName')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="CollegeCode" class="form-label">College Code</label>
                                                            <input type="text" class="form-control @error('CollegeCode') is-invalid @enderror" id="CollegeCode" name="CollegeCode" value="{{ old('CollegeCode', $college->CollegeCode) }}" required>
                                                            @error('CollegeCode')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Update College</button>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <form action="{{ route('colleges.toggle', $college->CollegeID) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary">{{ $college->IsActive ? 'Deactivate' : 'Activate' }}</button>
                                        </form>
                                        <form action="{{ route('colleges.destroy', $college->CollegeID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this college?')">
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
                </div>
            </div>
        </div>
    </div>
    <h3 class="mt-4">Deleted Colleges</h3>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>College Name</th>
                    <th>College Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deletedColleges as $college)
                    <tr>
                        <td>{{ $college->CollegeID }}</td>
                        <td>{{ $college->CollegeName }}</td>
                        <td>{{ $college->CollegeCode }}</td>
                        <td>
                            <form action="{{ route('colleges.restore', $college->CollegeID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No deleted colleges found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
