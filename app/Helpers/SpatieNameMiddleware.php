<?php

namespace App\Helpers;

use App\Enums\SpatieUserRoleEnum;

abstract  class SpatieNameMiddleware
{
    public static function admin(): string
    {
        return sprintf("role:%s", SpatieUserRoleEnum::ROLE_ADMIN->value);
    }

    public static function student(): string
    {
        return sprintf("role:%s", SpatieUserRoleEnum::ROLE_STUDENT->value);
    }
}
