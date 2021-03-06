<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Shop;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;



class ProductController extends Controller
{

    public function __construct()
    {
        $this->ImageController = new ImageController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allProduct = Product::all();
        $allProduct->map(function ($product){
           return $product->image = $product->images()->first()->url;
        });
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cariToko = $user->shop;
        $newProduct = Product::create([
            'productType_id' => $request->productType_id,
            'shop_id' => $cariToko->id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        $this->ImageController->store($request,$newProduct->id);
        return response()->json([
            'status' => '200',
            'message' => 'You have successfully create a Product',
            'data' => $newProduct
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $getProduct = Product::find($id);
        if($getProduct == null){
            return response()->json([
                'status' => 404,
                'message' => 'The product you are trying to find is not available'
            ]);
        }else{
            $getProduct->images = $getProduct->images();
            return response()->json([
                'status' => 200,
                'message' => 'Product found!',
                'data' => $getProduct
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //! nanti user lain yang gk punya shop ini bisa update product yang bukan punya dia (takutnya)

        $productOld = Product::where('id',$id)->first();

        if($productOld == null){
            return response()->json([
                'status' => 404,
                'message' => 'The product you are trying to find is not available'
            ]);
        }

        $productOld->update([
            'productType_id' => $request->productType_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        $productOld->save();
        $productOld->productType_id = (int)$productOld->productType_id;
        return response()->json([
            'status' => 200,
            'message' => 'Product successfully updated',
            'data' => $productOld
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ids
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $getProduct= Product::where('id',$id)->first();

        if($getProduct == null){
            return response()->json([
                'status' => 404,
                'message' => 'The product you are trying to find is not available'
            ]);
        }
        $getProduct->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Product Successfully deleted'
        ]);
    }

    public function getShopProducts(){
        $user = JWTAuth::parseToken()->authenticate();
        $cariToko = $user->shop;

       $allRelatedProduct = $cariToko->products;


       $allRelatedProductArr = $allRelatedProduct;
       foreach($allRelatedProductArr as $product){
           $product->shop_name = $product->shop->name;
       }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully retrieve all related shop products',
            'data' => $allRelatedProduct
        ]);

    }

    public function search(Request $request){
        $q =  $request->input('q');
        $Brandlist = Brand::where('name','LIKE','%'.$q.'%')->get();

        $productBrandList = Collection::make(new Product);

        foreach($Brandlist as $brand){
            $productBrandList = $productBrandList->merge(Product::where('brand_id',$brand->id)->get());
        }

        $productList =  Product::where('name','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
        $hasil = $productList->merge($productBrandList);
        return response()->json([
            'status' => 200,
            'message' => 'Displaying all items related to query',
            'data' => $hasil
        ]);
    }

}
