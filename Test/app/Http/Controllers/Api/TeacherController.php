<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return response()->json([
            'message' => 'Teachers retrieved successfully.',
            'data' => TeacherResource::collection($teachers)
        ]);
    }
    public function show (int $id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json([
            'message' => 'Teacher retrieved successfully.',
            'data' => new TeacherResource($teacher)
        ]);
    }
}
