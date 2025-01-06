<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOtpRequest;
use App\Http\Requests\OtpCodeRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserOtpResource;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserStoreRequest $userStoreRequest)
    {
        User::create($userStoreRequest->all());
    }

    public function ChkUser(OtpCodeRequest $otpCodeRequest)
    {
        $user = User::where('mobile',$otpCodeRequest->mobile)->first();
        if ($user)
        {
            $user_Otp = Otp::create([
                'code' => mt_rand(111111,999999),
                'mobile' => $user-> mobile,
            ]);
            return response()->json([
                "massage" => "کاربر با موفقیت یافت شد. و کد ارسال شد",
                "data" => new UserOtpResource($user_Otp)
            ],200);
        }
        else
        {
            return response()->json([
                "massage" => "کاربر یافت نشد!",
            ],318);
        }
    }

    public function ChkOtp(CheckOtpRequest $checkOtpRequest)
    {
        $chk_exist_otp = Otp::where('mobile', $checkOtpRequest->mobile)->where('code', $checkOtpRequest->code)->first();
        if ($chk_exist_otp) {
            $chk_exist_otp->delete();
            $user = User::where('mobile', $checkOtpRequest->mobile)->first();
            $token = $user->CreateToken("Login " . $user->name);
            return response()->json([
                "massage" => "کاربر با موفقیت وارد شد",
                "data" => new UserResource($user),
                "token" => $token->plainTextToken
            ], 200);
        } else
        {
            return response()->json([
                "massage" => "کد وارد شده اشتباه است!",
            ], 318);
        }
    }

    public function info_user(User $user)
    {
        return response()->json([
            "massage" => "اطلاعات کاربر با موفقیت دریافت شد",
            "data" => new UserResource($user),
        ], 200);
    }
}
