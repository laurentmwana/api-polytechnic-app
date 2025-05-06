<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SignedUrl;
use Illuminate\Http\Request;
use App\Models\OptUserVerified;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Notifications\CustomEmailVerification;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'verified',
                'message' => 'Votre adresse e-mail est déjà vérifiée.',
            ]);
        }

        $opt = OptUserVerified::query()->findOptOrCreate($user->id);

        $user->notify(
            new CustomEmailVerification(
                $opt
            )
        );

        return response()->json([
            'status' => 'sending',
            'message' => 'Un nouveau lien de vérification a été envoyé à votre adresse e-mail.',
        ]);
    }
}
