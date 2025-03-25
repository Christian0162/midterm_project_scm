<?php


namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colleges = College::where('IsActive', true)->get();
        return view('colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:50|unique:colleges,CollegeCode',
        ]);

        $validated['IsActive'] = true;

        College::create($validated);

        return redirect()->route('colleges.index')
                        ->with('success', 'College created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(College $college)
    {
        //
        return view('colleges.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(College $college)
    {
        //
        return view('colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        //
        $validated = $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => [
                'required',
                'string',
                'max:50',
                Rule::unique('colleges', 'CollegeCode')->ignore($college->CollegeID, 'CollegeID')
            ],
        ]);
        
        $college->update($validated);

        return redirect()->route('colleges.index')
                        ->with('success', 'College updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        // Implement soft delete by setting IsActive to false
        $college->update(['IsActive' => false]);

        return redirect()->route('colleges.index')
                        ->with('success', 'College deleted successfully');
    }
}
