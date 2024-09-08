<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GenaralApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use GenaralApiTrait;
    public function login(Request $request)
    {
        //validation

        try{


        $rule = [
            'email'=>'required',
            'password'=>'required'
        ];

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails())
        {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }

        //login
        $credintials=     $request->only(['email','password']);
        $token      =     Auth::guard('admin-api')->attempt($credintials);

            //return token
        }catch(\Exception $e){

        }
    }

    
}
