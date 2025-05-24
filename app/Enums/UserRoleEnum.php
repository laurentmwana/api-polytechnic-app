<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = "administrateur";
    case STUDENT = "étudiant";
    case DEFAULT = "inconnu(e)";
}
