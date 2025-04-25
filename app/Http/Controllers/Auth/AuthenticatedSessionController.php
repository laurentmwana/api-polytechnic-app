<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserLoginResource;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    public function login(Request $request): UserLoginResource|JsonResponse
    {
        $email = $request->email;

        $user = User::where('email', '=', $email)->first();

        if (!$user instanceof User || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => "Identifiants invalides",
            ], 401);
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
