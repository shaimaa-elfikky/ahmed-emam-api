<?php

namespace App\Http\Middleware;

use Closure;

class CheckLanguage
{

    public function handle($request, Closure $next)
    {
        app()->setlocale('ar');

        if(isset($request->lang) && $request->lang == 'en')
        {
            app()->setlocale('en');
        }
        
        return $next($request);
    }
}
