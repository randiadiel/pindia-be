<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class isUserShopOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($id,$request, Closure $next)
    {
        // Pre-Middleware Action
        $user = JWTAuth::parseToken()->authenticate();
        $product = Product::find($id);

        if ($user->shop->id !=  $product->shop_id){
            return response()->json([
                'status' => 401,
                'message' => 'Trying to gain access with wrong credential'
            ]);
        }else{
            $response = $next($request);
            return $response;
        }

    }
}
