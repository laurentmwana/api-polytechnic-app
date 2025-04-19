<?php

namespace App\Helpers;

use App\Enum\SpatieUserRoleEnum;

abstract  class SpatieNameMiddleware
{
    public static function admin(): string
    {
        return sprintf("role:%s", SpatieUserRoleEnum::ROLE_ADMIN->value);
    }
}
