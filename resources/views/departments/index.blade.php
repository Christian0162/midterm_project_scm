@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Departments</h2>
                
                
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddNewDepartment">
                    Add New Department
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="AddNewDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('departments.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="CollegeID" class="form-label">College</label>
                                    <select class="form-select @error('CollegeID') is-invalid @enderror" id="CollegeID" name="CollegeID" required>
                                        <option value="">Select College</option>
                                        @foreach($colleges as $college)
                                            <option value="{{ $college->CollegeID }}" {{ old('CollegeID') == $college->CollegeID ? 'selected' : '' }}>
                                                {{ $college->CollegeName }} ({{ $college->CollegeCode }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('CollegeID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="DepartmentName" class="form-label">Department Name</label>
                                    <input type="text" class="form-control @error('DepartmentName') is-invalid @enderror" id="DepartmentName" name="DepartmentName" value="{{ old('DepartmentName') }}" required>
                                    @error('DepartmentName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="DepartmentCode" class="form-label">Department Code</label>
                                    <input type="text" class="form-control @error('DepartmentCode') is-invalid @enderror" id="DepartmentCode" name="DepartmentCode" value="{{ old('DepartmentCode') }}" required>
                                    @error('DepartmentCode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Department</button>
                        </div>
                    </form>
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
                                <th>Department Name</th>
                                <th>Department Code</th>
                                <th>College</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $department)
                                <tr>
                                    <td>{{ $department->DepartmentID }}</td>
                                    <td>{{ $department->DepartmentName }}</td>
                                    <td>{{ $department->DepartmentCode }}</td>
                                    <td>{{ $department->college->CollegeName }}</td>
                                    <td class="d-flex gap-2 justify-content-center">


                                        {{-- View --}}
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show">
                                            View
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width: 150px;">Department ID:</th>
                                                            <td>{{ $department->DepartmentID }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department Name:</th>
                                                            <td>{{ $department->DepartmentName }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department Code:</th>
                                                            <td>{{ $department->DepartmentCode }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>College:</th>
                                                            <td>
                                                                <a href="{{ route('colleges.show', $department->CollegeID) }}">
                                                                    {{ $department->college->CollegeName }} ({{ $department->college->CollegeCode }})
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status:</th>
                                                            <td>{{ $department->IsActive ? 'Active' : 'Inactive' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>



                                          {{-- Edit --}}
                                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit">
                                            Edit
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('departments.update', $department->DepartmentID) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="CollegeID" class="form-label">College</label>
                                                            <select class="form-select @error('CollegeID') is-invalid @enderror" id="CollegeID" name="CollegeID" required>
                                                                <option value="">Select College</option>
                                                                @foreach($colleges as $college)
                                                                    <option value="{{ $college->CollegeID }}" {{ old('CollegeID', $department->CollegeID) == $college->CollegeID ? 'selected' : '' }}>
                                                                        {{ $college->CollegeName }} ({{ $college->CollegeCode }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('CollegeID')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="DepartmentName" class="form-label">Department Name</label>
                                                            <input type="text" class="form-control @error('DepartmentName') is-invalid @enderror" id="DepartmentName" name="DepartmentName" value="{{ old('DepartmentName', $department->DepartmentName) }}" required>
                                                            @error('DepartmentName')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="DepartmentCode" class="form-label">Department Code</label>
                                                            <input type="text" class="form-control @error('DepartmentCode') is-invalid @enderror" id="DepartmentCode" name="DepartmentCode" value="{{ old('DepartmentCode', $department->DepartmentCode) }}" required>
                                                            @error('DepartmentCode')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Update Department</button>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          
                                        <form action="{{ route('departments.destroy', $department->DepartmentID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No departments found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
