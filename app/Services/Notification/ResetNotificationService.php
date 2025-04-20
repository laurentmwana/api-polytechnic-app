<?php

namespace App\Services\Notification;

use App\Notifications\ResetPasswordNotification;

class ResetNotificationService
{
    public function __construct(private string $baseUrl)
    {
    }

}
