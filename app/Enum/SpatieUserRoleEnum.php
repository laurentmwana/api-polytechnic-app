<?php

namespace App\Enum;

enum SpatieUserRoleEnum: string
{
    case ROLE_ADMIN = "ROLE_ADMIN";

    case ROLE_STUDENT = "ROLE_STUDENT";

    case ROLE_ADMIN_DEPARTMENT = "ROLE_ADMIN_DEPARTMENT";

    case ROLE_PROFESSOR = "ROLE_PROFESSOR";

    case ROLE_PERSONAL_ACADEMIC = "ROLE_PERSONAL_ACADEMIC";
    
    case ROLE_ANONYMOUS = "ROLE_ANONYMOUS";
}
