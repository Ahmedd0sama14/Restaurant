<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTeacherRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        Teacher::create($data);
        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
