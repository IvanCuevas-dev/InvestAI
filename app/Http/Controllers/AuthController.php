<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'token_type' => 'Bearer',
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 201);
    }
}
