<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseSessionResource;
use App\Models\Course;

class CourseSessionController extends Controller
{
    public function index()
    {
        $sessions = Course::with('sessions')->paginate(10);
        return response()->json([
            "status" => "success",
            "data" =>CourseSessionResource::collection($sessions) ]);

    }

}
