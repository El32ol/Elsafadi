<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\Sanctum;

class AuthTokensController extends Controller
{
    public function index(Request $request)
    {
        //for getting the token of user there is a relation named tokens
        return $request->user()->tokens;//return all tokens of current user
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' =>'required',
            'password'=>'required',
            'device_name'=>'required',
            // 'permissions'=>'array',
            'fcm_device' =>'nullable',
        ]);

        $user = User::where('email' ,'=',$request->email)->first();

        if($user && Hash::check($request->password , $user->password))
        {
            //seconde arrguments for permission ['*']=> all permission
            //i can make our name of permissions ['aaaa.aa' , 'aaa']
           $token = $user->createToken($request->device_name , ['*'] , $request->fcm_device);//for make all permissions
        //    $token = $user->createToken($request->device_name , ['project.ar']);//for make some permissions
            
            return Response::json([
                'token' => $token->plainTextToken,
                'user' =>$user,
            ],201);
        }
        return Response::json([
            'message'=> 'invalid created',
        ],401);
    }

    public function destroy($id)
    {
        // for catch the user really make authentication
        $user = Auth::guard('sanctum')->user();

        //to catch the token which i want to remove with id
        $user->tokens()->findOrFail($id)->delete();

        //logout or delete all tokens 
        // $user->tokens()->delete();

        //logout or delete the current token
        // $user->currentAccessToken()->delete();

        // $token = $request->user()->currentAccessToken();
        return Response::json([
            'message' => 'token deleted',
        ]);
    }
}
