<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Models\Document;
use App\Models\Teacher;
use App\Services\FileService\FileService;

class DocumentController extends Controller
{
    public function __construct(protected FileService $courseService) {}
    public function index(Teacher $teacher)
    {
        $documents=$teacher->documents()->paginate(10);
        return view('teacher.document.index', compact('documents','teacher'));
    }
    public function create(Teacher $teacher)
    {
        return view('teacher.document.create', compact('teacher'));
    }
    public function store(StoreRequest $request, Teacher $teacher)
    {
        $data=$request->validated();
        $data['teacher_id']=$teacher->id;
        $data['path']=$this->courseService->HandleFile($request->file('path'),null,'document');
        $teacher->documents()->create($data);
        return redirect()->route('documents.index', $teacher)->with('success', 'Document created successfully');
    }
    public function edit(Teacher $teacher, Document $document)
    {
        return view('teacher.document.edit', compact('teacher', 'document'));
    }
    public function update(UpdateRequest $request,Teacher $teacher, Document $document)
    {
        $data=$request->validated();
        if ($request->hasFile('path')) {
         $data['path']=$this->courseService->HandleFile($request->file('path'),$document->path,'document');
        }
        $document->update($data);
        return redirect()->route('documents.index', $teacher)->with('success', 'Document updated successfully');

    }
    public function destroy(Teacher $teacher, Document $document)
    {
        $this->courseService->deleteFile($document->path);
        $document->delete();
        return redirect()->route('documents.index', $teacher)->with('success', 'Document deleted successfully');
    }

}
