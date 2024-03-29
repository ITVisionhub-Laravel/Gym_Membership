<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\NullableType;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|string|max:225',
            'email'=>'required|string|email|unique:users',
            'phone_number'=>'required|numeric|digits_between:9,11',
            'gender'=>'required|string',
            'password'=>'required|numeric|digits_between:4,6',
            'confirm_password'=>'required|numeric|same:password',
        ]);

        $user = new User([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'gender'=>$request->gender,
            'password'=>Hash::make($request->password),
            'confirm_password'=>Hash::make($request->password),

        ]);

        $user->save();

        $token = $user->createToken('Gym');

        $user->forceFill([
            'remember_token' => $token->plainTextToken,
        ])->save();

        return response()->json([
            'message' => 'User has been registered',
            'name' => $user->name,
            'gender' => $user->gender,
            'phone_number' => $user->phone_number,
            'token' => $token->plainTextToken
        ], 200);

    }

    public function login(Request $request){
        $request->validate([
           'email'=>'required|string|email',
            'password'=>'required|numeric'
        ]);

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Unauthorized'],401);
        }

        $user = User::find(auth()->user()->id);

        $token = $user->createToken('Gym')->plainTextToken;
        return response()->json([
            'message' => 'Login successfully',
            'token'=>$token
             ], 200);
    }

    public function logout(Request $request)
    {
        return response()->json(['message' => 'Successfully logged out']);
        // $request->user()->token()->revoke();
        // return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
