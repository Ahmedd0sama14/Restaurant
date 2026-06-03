<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Traits\RespondTrait;

class TeacherController extends Controller
{ use RespondTrait;
    public function index()
    {
        $teachers = Teacher::latest()->with('documents')->paginate(10);
        return $this->successResponse(TeacherResource::collection($teachers));
    }
    public function show (int $id)
    {
        $teacher = Teacher::with('documents')->findOrFail($id);
        return $this->successResponse(new TeacherResource($teacher));
    }
}
