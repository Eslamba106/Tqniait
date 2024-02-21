<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\UserServices;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $code = rand(100000, 999999);
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'phone_verify_code' => $code,
        ]);

        return response()->apiSuccess('Register Success Go To verify Your Account');
    }

    public function verifyCode(Request $request){
        $user = User::where('phone' , $request->phone)->first();        
        if($request->verifyCode == $user->phone_verify_code){
            $user->update([
                'phone_verified_at'=> Carbon::now()
            ]);
            return "Verify Complete";
        }else{
            return "Code Is Not Correct";
        }
    }
}


