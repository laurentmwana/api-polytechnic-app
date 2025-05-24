<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserLoginResource;

class AuthenticatedSessionController extends Controller
{
    public function login(LoginRequest $request): UserLoginResource | JsonResponse
    {
        if (! $token = Auth::attempt($request->validated())) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->getResponseUser($request->user(), $token);
    }

    public function refresh(Request $request): UserLoginResource | JsonResponse
    {
        if (! $token = Auth::refresh()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->getResponseUser($request->user(), $token);
    }

    private function getResponseUser(User $user, string $token): UserLoginResource
    {
        $user->token = $token;
        return new UserLoginResource($user);
    }
}
