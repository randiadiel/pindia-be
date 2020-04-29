<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;



class ProductController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProduct = Product::all();
        return response()->json([
            'status' => 200,
            'message' => 'All products successfully retrieved',
            'data' => $allProduct
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cariToko = Shop::where('user_id','=',$user->id)->first();

        $newProduct = Product::create([
            'productType_id' => $request->productType_id,
            'shop_id' => $cariToko->id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        $newProduct->save();

        $databaseProduct = Product::where('id',$newProduct->id)->first();
        return response()->json([
            'status' => '200',
            'message' => 'You have successfully create a Product',
            'data' => $databaseProduct
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
