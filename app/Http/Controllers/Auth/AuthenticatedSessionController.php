<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserLoginResource;

class AuthenticatedSessionController extends Controller
{

    public function login(LoginRequest $request): UserLoginResource|array
    {
        $email = $request->email;

        $user = User::where('email', '=', $email)->first();

        if (!$user instanceof User) {
            return ['credentials' => "Invalid credentials"];
        }
        return new UserLoginResource($user);
    }

    public function destroy(Request $request): array
    {
        $request->user()->currentAccessToken()->delete();

        return ['data' => [
            'message' => "Vous êtes déconnecté (:",
        ]];
    }
}
