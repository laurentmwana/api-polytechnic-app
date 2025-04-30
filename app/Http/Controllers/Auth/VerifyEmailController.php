<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyEmailController extends Controller
{
    public function __invoke(int $id, string $hash, Request $request): JsonResponse
    {
        $user = $request->user();

        if (($id !== $user->id) || sha1($user->email) !== $hash) {
            abort(403, "Impossible de vérifier votre adresse e-mail. Veuillez vous reconnecter et réessayer.");
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'verified',
                'message' => 'Votre adresse e-mail a déjà été vérifiée.',
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'status' => 'verified',
            'message' => 'Votre adresse e-mail a été vérifiée avec succès.',
        ]);
    }
}
