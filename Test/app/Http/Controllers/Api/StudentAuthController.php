<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\OTPRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\StudentResetPasswordRequest;
use App\Http\Resources\StudentLoginResource;
use App\Http\Resources\StudentRegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{

    public function register(StudentRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->generateOTP();
        return response()->json([
            'message' => 'Registration successful. OTP sent to email.',
            'Data' => new StudentRegisterResource($user),
        ], 201);
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
            return response()->json([
                'message' => 'OTP verified successfully',
                'Data' => new StudentLoginResource($user),
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid OTP or OTP expired'
        ], 400);
    }
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->generateOTP();
        return response()->json([
            'message' => 'OTP resent successfully',
            'Data' => $user,
        ]);
    }

    public function login(StudentLoginRequest $request)
    {
        $user = User::where('email', $request['email'])->first();
        if (Hash::check($request['password'], $user->password)) {
            $user->generateOTP();
            return response()->json([
                'message' => 'Login successful',
                'data' => new StudentLoginResource($user)
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid email or password'
        ], 400);
    }
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->generateOTP();
            return response()->json([
                'message' => 'Password reset OTP sent to email.',
                'otp' => $user->otp,
            ], 200);
        }
        return response()->json([
            'message' => 'Email not found'
        ], 404);
    }
    public function verifyCode(OTPRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (
            $user &&
            $user->otp_expires_at &&
            $request->otp == $user->otp &&
            now()->lessThan($user->otp_expires_at)
        ) {
            return response()->json([
                'message' => 'OTP verified successfully Go to reset password page',
                'Data' => $user,
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid OTP or OTP expired'
        ], 400);
    }
    public function verifyResetPassword(StudentResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (
            $user &&
            $user->otp_expires_at &&
            $request->otp == $user->otp &&
            now()->lessThan($user->otp_expires_at)
        ) {
            $user->resetOTP();
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json([
                'message' => 'Password reset successfully Go to login page',
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid OTP or OTP expired'
        ], 400);
    }
    public function delete()
    {
        $user = Auth::user();
        $user->delete();

        return response()->json([
            'message' => 'Account deleted successfully'
        ]);
    }
        public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
