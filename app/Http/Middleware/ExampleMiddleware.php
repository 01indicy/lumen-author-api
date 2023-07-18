<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {

        if(!$request->hasHeader('Authorization')){
            return response()->json(['error'=>'Header must require authorization']);
        }

        return $next($request);
    }
}
