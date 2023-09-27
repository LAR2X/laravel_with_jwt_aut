<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JWTAuthController extends Controller
{

    public function _contruct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    

    public function register(Request $request){

        $validator = Validator::make($request->all(),[

            'name' =>'required:between:2,100',
            'email'=>'required|email|unique:users|max:50',
            'password' =>'required|string|min:6'
        ]);
        

        $user=\App\Models\Client::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));


        return response()->json([
            'message'=> "successfully created account.",
            'user'=>$user
        ]);

    }


    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=> 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if(!$token = auth()->guard('api')->attempt($validator->validated()) ){
            return response()->json(['error'=> 'Unauthorized user login attempt', 401]);
        }

        return $this->createNewToken($token);
      
    }



    // public function refresh(){
    //     return [$this->createNewToken(auth()->guard('api')->refresh())];
    // }


    public function createNewToken($token){

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTl()*60
        ]);
    }
}
