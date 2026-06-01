<?php

namespace App\Http\Controllers;

use App\Enums\Course\CourseDiscountTypeEnum;
use App\Enums\Course\CourseDurationTypeEnum;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CourseTypes;
use App\Models\Teacher;
use App\Services\Course\CourseService;

class CourseController extends Controller

{
    public function __construct(protected CourseService $courseService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('teacher', 'courseType')->paginate(6);
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $courseTypes = CourseTypes::all();
        $durationTypes = CourseDurationTypeEnum::cases();
        $discountTypes = CourseDiscountTypeEnum::cases();
        return view('course.create', compact('teachers', 'courseTypes', 'durationTypes', 'discountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $this->courseService->create($data);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $teachers = Teacher::all();
        $courseTypes = CourseTypes::all();
        $durationTypes = CourseDurationTypeEnum::cases();
        $discountTypes = CourseDiscountTypeEnum::cases();
        return view('course.edit', compact('course', 'teachers', 'courseTypes', 'durationTypes', 'discountTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {

        $this->courseService->update($request->validated(),$course);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->courseService->delete($course);
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
