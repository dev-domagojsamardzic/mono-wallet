<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Simple login function (send only username)
     *
     * @param App\Http\Requests\UserLoginRequest $request
     *
     * @return Illuminate\Support\Http\JsonResponse
     */

    public function login(UserLoginRequest $request): JsonResponse
    {

        // Retrieve user by username
        $user = User::where('username', $request->username)->first();

        // Delete previous tokens
        $user->tokens()->delete();

        // Create token and retrieve it's plain text value
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
