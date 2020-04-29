<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class HaveSellerAccessMiddleware
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
        // Pre-Middleware Action

        $user = JWTAuth::parseToken()->authenticate();
        
        if($user->role != 2){
            return response()->json([
                'status' => 403,
                'message' => 'Please create a shop first'
            ]);
        }else{

            $response = $next($request);

            // Post-Middleware Action
    
            return $response;
        }
    }
}
