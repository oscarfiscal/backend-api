<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Login as LoginResource;
use App\Http\Requests\Login as LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
 


    public function login(Request $request)
    {
     
         
              $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
                $accessToken = auth()->user()->createToken('my-app-token')->plainTextToken;
                 return response()->json(new LoginResource($accessToken), 200);
              
            }

    }


   
}
