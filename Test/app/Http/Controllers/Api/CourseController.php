<?php

namespace App\Http\Controllers\Api;

use App\Enums\Course\CourseDiscountTypeEnum;
use App\Enums\Course\CourseDurationTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\Course\CourseService;
class CourseController extends Controller

{
    public function __construct(protected CourseService $CourseService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $courses = Course::with('teacher', 'courseType')->paginate(6);
        return response()->json([
            "message" => "success",
            "data" =>  CourseResource::collection($courses)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $course=$this->CourseService->create($data);

        return response()->json([
            "message" => "success",
            "data" =>  new CourseResource($course)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json([
            "message" => "success",
            "data" =>  new CourseResource($course)
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {

        $this->CourseService->update($request->validated(), $course);

        return response()->json([
            "message" => "success",
            "data" =>  new CourseResource($course)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course) {}
}
