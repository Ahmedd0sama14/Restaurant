<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\Course\CourseService;
use App\Traits\RespondTrait;

class CourseController extends Controller

{
    use RespondTrait;
    public function __construct(protected CourseService $CourseService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $courses = Course::with('teacher', 'courseType')->paginate(6);
        return $this->successResponse(CourseResource::collection($courses), 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $course=$this->CourseService->create($data);

        return $this->successResponse(new CourseResource($course), 'Course created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('teacher', 'courseType');
        return $this->successResponse(new CourseResource($course), 'success', 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {

        $this->CourseService->update($request->validated(), $course);

        return $this->successResponse(new CourseResource($course), 'Course updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course) {
        $this->CourseService->delete($course);
        return $this->successResponse(null, 'Course deleted successfully', 204);

    }
}
