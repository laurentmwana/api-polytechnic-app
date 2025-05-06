<?php

namespace App\Eloquent;

use Illuminate\Support\Str;
use App\Models\OptUserVerified;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OptUserEloquent extends Builder
{
    /**
     * Trouve un OptUserVerified valide ou en crée un nouveau (ou met à jour).
     *
     * @param  int  $userId
     * @return OptUserVerified
     */
    public function findOptOrCreate(int $userId): OptUserVerified
    {
        // Supprime les enregistrements expirés dans une transaction (au cas où)
        DB::transaction(function () {
            $this->where('expirate', '<', now())->delete();
        });

        // Cherche un opt valide pour l'utilisateur
        $opt = $this->where('user_id', '=', $userId)
            ->where('expirate', '>', now())
            ->first();

        if ($opt) {
            return $opt;
        }

        // Pas d'opt valide, on crée ou met à jour l'enregistrement unique
        return $this->createOpt($userId);
    }

    /**
     * Trouve un OptUserVerified par user_id et opt valide.
     *
     * @param  int     $userId
     * @param  string  $opt
     * @return OptUserVerified|null
     */
    public function findOpt(int $userId, string $opt): ?OptUserVerified
    {
        return $this->where('user_id', $userId)
            ->where('expirate', '>', now())
            ->where('opt', $opt)
            ->first();
    }

    /**
     * Crée ou met à jour un OptUserVerified pour un utilisateur donné.
     *
     * @param  int  $userId
     * @return OptUserVerified
     */
    private function createOpt(int $userId): OptUserVerified
    {
        $optCode = Str::upper(Str::random(6));
        $expiration = now()->addHours(2);

        return self::create([
            'opt' => $optCode,
            'user_id' => $userId,
            'expirate' => $expiration,
        ]);
    }
}
