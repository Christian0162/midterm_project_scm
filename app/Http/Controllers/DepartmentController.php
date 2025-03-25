<?php


namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('college')
                                ->where('IsActive', true)
                                ->get();
        $colleges = College::where('IsActive', true)->get();
        return view('departments.index', compact('departments', 'colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colleges = College::where('IsActive', true)->get();
        return view('departments.create', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CollegeID' => 'required|exists:colleges,CollegeID',
            'DepartmentName' => 'required|string|max:255',
            'DepartmentCode' => 'required|string|max:50|unique:departments,DepartmentCode',
        ]);

        $validated['IsActive'] = true;

        Department::create($validated);

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $colleges = College::where('IsActive', true)->get();
        return view('departments.edit', compact('department', 'colleges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'CollegeID' => 'required|exists:colleges,CollegeID',
            'DepartmentName' => 'required|string|max:255',
            'DepartmentCode' => [
                'required',
                'string',
                'max:50',
                Rule::unique('departments', 'DepartmentCode')->ignore($department->DepartmentID, 'DepartmentID')
            ],
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully');
    }

    /**
     * Soft delete the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Implement soft delete by setting IsActive to false
        $department->update(['IsActive' => false]);

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully');
    }
}
