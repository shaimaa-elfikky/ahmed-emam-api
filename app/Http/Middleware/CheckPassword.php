<?php

namespace App\Http\Middleware;



use Closure;

class CheckPassword
{


    function handle($request, Closure $next)
    {

        if($request->api_password !== env('API_PASSWORD', 'z9SnP2OMy8ZCZ7rER2PFYwt')){
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        return $next($request);
    }
}
