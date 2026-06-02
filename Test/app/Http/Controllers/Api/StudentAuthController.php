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
use App\Traits\RespondTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    use RespondTrait;

    public function register(StudentRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->generateOTP();
        return $this->successResponse(new StudentRegisterResource($user), 'Student registered successfully', 201);
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
            $user->Verify=true;
            $user->save();
            return $this->successResponse(new StudentLoginResource($user), 'OTP verified successfully', 200);
        }
        return $this->errorResponse('Invalid OTP or OTP expired', 400);
    }
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->generateOTP();
        return $this->successResponse(['otp' => $user->otp], 'OTP resent successfully', 200);
    }

    public function login(StudentLoginRequest $request)
    {
        $user = User::where('email', $request['email'])->first();
        if (Hash::check($request['password'], $user->password)) {
            if($user->verify){
                Auth::login($user);
                return $this->successResponse(new StudentLoginResource($user), 'Login successful', 200);
            }
            $user->generateOTP();
            return $this->successResponse([
              'Data' => new StudentLoginResource($user)],
              'Login successful, OTP sent to email', 200);
        }
        return $this->errorResponse('Invalid email or password', 400);
    }
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->generateOTP();
            return  $this->successResponse (['otp' => $user->otp], 'OTP sent to email for password reset', 200);
        }
        return $this->errorResponse('Email not found', 404);
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
            return $this->successResponse(null, 'OTP verified successfully', 200);
        }
        return $this->errorResponse('Invalid OTP or OTP expired', 400);
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
            return $this->successResponse(null, 'Password reset successfully', 200);
        }
        return $this->errorResponse('Invalid OTP or OTP expired', 400);
    }
    public function delete()
    {
        $user = Auth::user();
        $user->delete();
        return $this->successResponse(null, 'Account deleted successfully', 204);
    }
        public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, 'Logged out successfully', 200);
    }
}
