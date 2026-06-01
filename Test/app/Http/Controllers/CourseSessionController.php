<?php

namespace App\Http\Controllers;

use App\Enums\Session\SessionTypeEnum;
use App\Http\Requests\StoreCourseSession;
use App\Http\Requests\UpdateCourseSessionRequest;
use App\Models\Course;
use App\Models\CourseSession;
use App\Services\FileService\FileService;
use Illuminate\Http\Request;

class CourseSessionController extends Controller
{
    public function __construct(protected FileService $fileService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = CourseSession::with('course')->paginate(10);
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $sessionsTypes = SessionTypeEnum::cases();
        return view('sessions.create', compact('courses', 'sessionsTypes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseSession $request)
    {
        $data = $request->validated();
        $data['file'] = $this->fileService->HandleFile($request->file('file'),null,'sessions');
        CourseSession::create($data);
        return redirect()->route('sessions.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSession $session)
    {
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSession $session)
    {
        $courses = Course::all();
        $sessionsTypes = SessionTypeEnum::cases();
        return view('sessions.edit', compact('session', 'courses', 'sessionsTypes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseSessionRequest $request, CourseSession $session)
    {
        $data = $request->validated();
        if ($request->hasFile('file')){
            $data['file'] = $this->fileService->HandleFile($request->file('file'),$session->file,'sessions');
        }
        $session->update($data);
        return redirect()->route('sessions.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSession $session)
    {
        $session->delete();
        $this->fileService->DeleteFile($session->file);
        return redirect()->route('sessions.index');
    }
}
