<?php

namespace App\Http\Controllers\Other;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\Notification\NotificationsResource;

class NotificationController extends Controller
{
    /**
     * Affiche la liste des notifications de l'utilisateur connecté.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Récupérer la limite depuis la query string, valeur par défaut à null
        $limit = $request->query('limit');
        $limit = is_numeric($limit) ? (int) $limit : null;

        $builder = $this->getQueryNotification($user);

        $notifications = $limit !== null && $limit > 0
            ? $builder->limit($limit)->get()
            : $notifications = $builder->paginate();

        return NotificationsResource::collection($notifications);
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @return NotificationResource
     */
    public function show(int $id, Request $request)
    {
        $user = $request->user();

        $builder = $this->getQueryNotification($user);

        $notification = $builder->findOrFail($id);

        return new NotificationResource($notification);
    }

    /**
     *
     * @param  User  $user
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    private function getQueryNotification(User $user)
    {
        return $user->notifications()
            ->orderByDesc('updated_at')
            ->orderByDesc('created_at');
    }
}
