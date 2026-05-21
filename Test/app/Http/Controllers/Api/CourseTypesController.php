<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTypesRequest;
use App\Http\Resources\CourseTypesRecourse;
use App\Models\CourseTypes;


class CourseTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CourseTypes::all();
        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseTypesRequest $request)
    {
        $data = $request->validated();
        $courseType = CourseTypes::create($data);
        return response()->json([
            'message' => 'Course Type created successfully',
            'data' => $courseType,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(courseTypes $courseTypes)
    {
        return response()->json([
            'message' => 'success',
            'data' => $courseTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseTypesRequest $request, courseTypes $courseTypes)
    {
        $data = $request->validated();
        
        $dataResponse = $courseTypes->update($data);
        return response()->json([
            'message' => 'Course Type updated successfully',
            'data' => new CourseTypesRecourse($dataResponse),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(courseTypes $courseTypes)
    {
        $courseTypes->delete();
        return response()->json([
            'message' => 'Course Type deleted successfully',
        ]);
    }
}
