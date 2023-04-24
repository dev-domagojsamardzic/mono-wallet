<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login(UserLoginRequest $request) {

        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
