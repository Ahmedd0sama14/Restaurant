@extends('student.dashbord.layouts')
@section('title', 'Student Dashboard')
@section('sidebar')
    <li class="menu-item active">
        <a href="" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div>Dashboard</div>
        </a>
    </li>
    @endsection
@section('content')
    <h1>Welcome to Student Dashboard</h1>
    <p>This is the main content area of the student dashboard.</p>
    @endsection
