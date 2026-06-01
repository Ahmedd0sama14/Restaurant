<?php

namespace App\Http\Controllers;

use App\Http\Requests\OTPRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentAuthController extends Controller
{
    public function showRegister()
    {
        return view('student.auth.register');
    }
    public function register(StudentRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->generateOTP();
        return view('student.auth.otp', ['email' => $user->email]);
    }
    public function showOtp(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('student.register');
        }

        return view('student.auth.otp', compact('email'));
    }
    public function otp(OTPRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (
            $user &&
            $user->otp_expires_at &&
            $request->otp == $user->otp &&
            now()->lessThan($user->otp_expires_at)
        ) {
            Auth::login($user);

            $user->resetOTP();

            return to_route('student.dashboard');
        }

        return redirect()->route('student.otp', ['email' => $request->email])
            ->withErrors(['otp' => 'Invalid OTP']);
    }

    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->generateOTP();
        return back()->with('success', 'OTP sent successfully');
    }
    public function showlogin()
    {
        return view('student.auth.login');
    }
    public function login(StudentLoginRequest $request)
    {
        $user = User::where('email', $request['email'])->first();
        if (Hash::check($request['password'], $user->password)) {
            $user->generateOTP();
            return view('student.auth.otp', ['email' => $user->email]);
        }
        return redirect()->route('student.login')
            ->withErrors(['email' => 'invalid email or password ']);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }
}
