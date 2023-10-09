<?php

namespace Ajtarragona\Anicom\Middlewares;

use Closure;

class AnicomBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if (!config("anicom.backend")) {
    		 $error=__("Oops! Anicom backend is disabled");
    		 return view("anicom-client::erroraccede",compact('error'));
        }

        return $next($request);
    }
}