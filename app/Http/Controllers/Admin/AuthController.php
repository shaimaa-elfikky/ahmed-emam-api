<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GenaralApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $credintials =     $request->only(['email','password']);
        $token      =     Auth::guard('admin-api')->attempt($credintials);

        //return token


        if(!$token)

            return $this->returnError('E001','بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();

            $admin->api_token =  $token ;

            return $this->returnData('admin',$admin,'');



        }catch(\Exception $e){
           return $this->returnError($e->getCode() , $e->getMessage());
        }
    }


    public function logout(Request $request)
    {
        //dd($request);
        $token = $request ->header('auth-token');
        dd($token);
        if ($token) {
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return  $this->returnError('', 'some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        } else {
            $this->returnError('', 'some thing went wrong');
        }
    }


}
