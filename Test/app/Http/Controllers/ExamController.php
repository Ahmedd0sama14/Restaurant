<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Services\FileService\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function __construct(protected FileService $fileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->fileService->HandleFile($data['image'], null, 'exams');
        Exam::create($data);
        return redirect()->route('exams.index')->with('success', 'Exam created successfully');

    }
        public function toggle(Exam $exam)
        {
            $exam->is_active = !$exam->is_active;
            $exam->save();
            return redirect()->route('exams.index')->with('success', 'Exam status toggled successfully');
        }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        return view('admin.exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $this->fileService->HandleFile($data['image'], $exam->image, 'exams');
        }
        $exam->update($data);
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        $this->fileService->deleteFile($exam->image);
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully');
    }
}
