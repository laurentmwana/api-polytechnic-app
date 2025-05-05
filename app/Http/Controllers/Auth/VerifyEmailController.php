<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\OptUserVerified;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    public function __invoke(string $opt, Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'verified',
                'message' => 'Votre adresse e-mail a déjà été vérifiée.',
            ]);
        }

        $optUser = OptUserVerified::query()->findOpt($user->id, $opt);

        if (null === $optUser) {
            abort(403, "otre opt n'est pas valide");
        }

        $optUser->delete();

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'status' => 'verified',
            'message' => 'Votre adresse e-mail a été vérifiée avec succès.',
        ]);
    }
}
