<?php

namespace App\Http\Controllers;

use App\Enums\Admin\AdminTypeEnum;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMemberController extends Controller
{
    public function index()
    {
        $members = Admin::Where('role', AdminTypeEnum::MEMBER)->paginate(5);
        return view('admin.member.index', compact('members'));
    }
    public function create()
    {
        return view('admin.member.create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = AdminTypeEnum::MEMBER;
        Admin::create($data);
        return redirect()->route('admin.members.index')->with('success', 'Admin created successfully');
    }
    public function edit(Admin $member)
    {
        return view('admin.member.edit', compact('member'));
    }
     public function update(UpdateAdminRequest $request, Admin $member)
    {
        $data = $request->validated();
        $admin->update($data);
        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully');
    }

    public function destroy(Admin $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Member deleted successfully');
    }
}
