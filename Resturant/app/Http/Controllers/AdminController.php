<?php

namespace App\Http\Controllers;

use App\Enums\Admin\AdminTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class AdminController extends  Controller
{

    public function index()
    {
        $restaurants = Restaurant::withCount('branches')->get();
        return view('admin.dashbord.index', [
            'restaurantsCount' => Restaurant::count(),
            'branchesCount'    => Branch::count(),
            'adminsCount'      => Admin::count(),
            'latestRestaurants' => Restaurant::latest()->take(5)->get(),
            'latestBranches' => Branch::with('restaurant')->latest()->take(5)->get()
        ]);
    }
    public function showAllAdmin()
    {
        $admins = Admin::Where('role', AdminTypeEnum::ADMIN)->paginate(5);
        return view('admin.auth.index', compact('admins'));
    }
    public function create()
    {
        return view('admin.auth.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = AdminTypeEnum::ADMIN;
        Admin::create($data);
        return redirect()->route('admin.dashboard')->with('success', 'Admin created successfully');
    }
    public function edit(Admin $admin)
    {
        return view('admin.auth.edit', compact('admin'));
    }
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->validated();
        $admin->update($data);
        return redirect()->route('admin.alladmin')->with('success', 'Admin updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function login()
    {
        return view('admin.auth.login');
    }
    public function authenticate(LoginRequest  $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function delete(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.alladmin')->with('success', 'Admin deleted successfully');
    }
}
