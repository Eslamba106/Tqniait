<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\UserServices;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }
    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required|string',
        ]);

        // Check if the user is verified
        $user = User::where('phone', $request->phone)->first();
        if ($user->phone_verified_at == null) {
            Log::info("ID: $user->id, Verified Code: $user->phone_verify_code");
            return "Send Verify Code";
        } else {
            if(Auth::attempt(['phone'=>$request->phone , 'password'=>$request->password])){
            return response([
                'user' => $user,
                'access_token' => $user->createToken('auth_token')->plainTextToken,
            ], 200);
        }   
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'massege' => 'User Successfully logout',
        ] , 200);
    }
}
