<?php

namespace App\Http\Middleware;

use App\Http\Traits\GenaralApiTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class CheckAdminToken
{
    use GenaralApiTrait;

    public function handle($request, Closure $next)
    {

        $user = null;
        try {
            // Parse the token from the request
            $user = JWTAuth::parseToken()->authenticate();

            // Check if the user is an admin
            // if (!$user || !$user->is_admin) {
            //     return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            // }
        } catch (\Exception $e)
        {
            if($e instanceof  \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return $this->returnError('E3001', 'INVALID_TOKEN');

            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return $this->returnError('E3001','EXPIRED_TOKEN');
            }else
            {
                return $this->returnError('E3001','TOKEN_NOT_FOUND');
            }


            // return response()->json(['error' => 'Token is invalid or expired'], Response::HTTP_UNAUTHORIZED);
        }catch (\Throwable $e)

        {
              if($e instanceof  \Tymon\JWTAuth\Exceptions\TokenInvalidException)
              {

                return $this->returnError('E3001', 'INVALID_TOKEN');

               } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError('E3001','EXPIRED_TOKEN');

        }else{
                return $this->returnError('E3001','TOKEN_NOT_FOUND');
        }
        }

        if(!$user)
        {
            return  $this->returnError('E3001', 'Unauthintecated');
        }

        return $next($request);
    }
    }

