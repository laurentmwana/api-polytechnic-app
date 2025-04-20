<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Helpers\SignedUrl;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
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

        $user->notify(new CustomEmailVerification(SignedUrl::getVerifyUrl($user)));

        return response()->json([
            'status' => 'sending',
            'message' => 'Un nouveau lien de vérification a été envoyé à votre adresse e-mail.',
        ]);
    }

}
