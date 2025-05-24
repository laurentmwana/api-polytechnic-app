<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!($user instanceof User)) {
            return response()->json([
                'message' => "Utilisateur non authentifié."
            ], 401);
        }

        $formatRole = $this->getRoleFormat($role);

        // Vérifie si l'utilisateur a le rôle demandé
        if ($user->role === $formatRole) {
            return $next($request);
        }

        // Messages selon le rôle demandé
        switch ($formatRole) {
            case UserRoleEnum::ADMIN->value:
                $message = "Cette route est réservée aux administrateurs.";
                break;
            case UserRoleEnum::STUDENT->value:
                $message = "Cette route est réservée aux étudiants.";
                break;
            default:
                $message = "Accès refusé : rôle inconnu ou insuffisant.";
                break;
        }

        return response()->json([
            'message' => $message
        ], 403);
    }

    private function getRoleFormat(string $role): string
    {
        return explode(':', $role)[1];
    }
}
