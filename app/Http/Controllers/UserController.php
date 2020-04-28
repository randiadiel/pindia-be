<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
       $match = User::where('email', '=', $request->email)->first();

       if($match == null){

        $userBaru = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'telephone' => $request->telephone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' =>  1
        ]);
        
        $userBaru->save();

        return response()->json([
           'status' => 200,
           'message' => 'You have successfully registered',
           'data' => [
            'id' => $userBaru->id,
            'email' => $userBaru->email,
            'name' => $userBaru->name,
            'role' => $userBaru->role,
            'address' => $userBaru->address,
            'telephone' => $userBaru->telephone,
            'birthday' => $userBaru->birthday,
            'gender' => $userBaru->gender
           ] 
        ]);
       }else{
           return response()->json([
               'status' => 422,
               'message' => 'Email has already registered'
           ]);
       }

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
