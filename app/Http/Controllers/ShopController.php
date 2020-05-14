<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {


        $user = JWTAuth::parseToken()->authenticate();

        $cariToko = $user->shop;

        if($cariToko != null){
            return response()->json([
                'status' => 401,
                'message' => 'You already have a shop!'
            ]);
        }


        $shopBaru = Shop::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address
        ]);

        $shopBaru->save();

        $user->role = 2;
        $user->save();

        return response()->json([
           'status' => 200,
           'message' => 'You have successfully created a shop!',
           'data' => [
            'id' => $shopBaru->id,
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address
           ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cariToko = $user->shop;

            return response()->json([
                'status' => 200,
                'message' => 'Successfully get shop',
                'data' => $cariToko
            ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cariToko = $user->shop;

        $cariToko->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        $cariToko->save();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully updated your shop',
            'data' => $cariToko
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $cariToko = $user->shop;

            $cariToko->delete();
            return response()->json([
                'status' => 200,
                'message' => 'You have successfully deleted a shop'
            ]);


    }
}
