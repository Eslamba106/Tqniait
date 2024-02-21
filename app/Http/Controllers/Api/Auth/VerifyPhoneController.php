<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyPhoneController extends Controller
{
    public function __invoke(Request $request){
        if($request->user()->hasVerifiedPhone()){
            return response("the phone is verified");
        }
        $request->validate([
            "code"=> ["required" , "numeric"],
        ]);

        if($request->code === auth()->user()->phone_verify_code){
            
        }
    }
}
