<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationType\StoreRequest;
use App\Models\EducationType\EducationTypes;
use Illuminate\Http\Request;

class EducationTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationTypes = EducationTypes::with('translations')->get();;
        return view('EducationTypes.index', compact('educationTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('EducationTypes.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        EducationTypes::create($data);
        return redirect()->route('education-types.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationTypes $education_type)
    {
        return view('EducationTypes.edit', compact('education_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationTypes $education_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationTypes $education_type)
    {
        $education_type->delete();
        return redirect()->route('education-types.index');
    }
}
