<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
        ],401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'user' => $user,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
             )->toDateTimeString()
     ]);
   }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $userCheck = User::where('email', $request->email)
        ->first();

        if($userCheck == null){
            $user = new User;
            $user->username = strval($request->username);
            $user->first_name = strval($request->first_name);
            $user->last_name = strval($request->last_name);
            $user->email = strval($request->email);
            $user->password = bcrypt(strval($request->password));
            $user->save();
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        }
        else{
            return response()->json([
                'message' => 'User already exists'
            ], 409);
        }
   }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
