<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\UpdateAdminStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students_count = User::count();
        $students = User::with('course')->paginate(10);
        return view('admin.students.index', compact('students', 'students_count'));
    }
    public function show(User $student)
    {
        return view('admin.students.show', compact('student'));
    }
    public function create()
    {
        return view('admin.students.create');
    }
    public function store(StudentRegisterRequest $request)
    {
        $data = $request->validated();
        $data['verify'] = 1;
        $data['password']=Hash::make($data['password']);
        User::create($data);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }
    public function update(UpdateAdminStudentRequest $request, User $student)
    {
        $data=$request->only('name','email','phone');
        if($request->filled('password')){
            $data['password']=Hash::make($request->password);
        }
        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');

    }
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

}
