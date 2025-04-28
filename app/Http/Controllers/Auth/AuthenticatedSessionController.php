<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (! $token = Auth::attempt($request->validated())) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function destroy(): array
    {
        Auth::logout();

        return ['data' => [
            'message' => "Vous êtes déconnecté (:",
        ]];
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 90000
        ]);
    }
}
