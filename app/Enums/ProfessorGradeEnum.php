<?php

namespace App\Enums;

enum ProfessorGradeEnum: string
{
    case DOYEN = "doyen";
    case SEMIDOYEN = "vice-doyen";
    case SEARCH = "chargé de la recherche";
}
