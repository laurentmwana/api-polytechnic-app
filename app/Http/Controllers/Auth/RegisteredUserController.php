<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\SpatieUserRoleEnum;
use App\Helpers\SignedUrl;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\CustomEmailVerification;
use App\Http\Resources\User\UserRegisterResource;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request): UserRegisterResource
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(
            Role::findByName(SpatieUserRoleEnum::ROLE_ANONYMOUS->value)
        );

        $user->notify(new CustomEmailVerification(
            SignedUrl::getVerifyUrl($user),
        ));

        return new UserRegisterResource($user);
    }
}
