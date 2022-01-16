<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $postData = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = User::create($postData);
        return response()->json( $user);
    }

    public function logginUser(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if(!$user || !Hash::check($request->get('password'), $user->password)){
            return response()->json( [
                "message" => "Input credentials are wrong!!!"
            ]);
        }
        $personToken = $user->createToken('access-token')->plainTextToken;
        return response()->json( [
            "user"=>$user,
            "token"=>$personToken
        ]);
    }

    public function loggOutUser(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json( [
            "message"=>"user logger out successfully!!!",
        ]);
    }
}
