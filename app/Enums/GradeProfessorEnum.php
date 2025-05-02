<?php

namespace App\Enums;

enum GradeProfessorEnum: string
{
    case DEAN = "Doyen";
    case VICE_DEAN = "Vice-doyen";
    case RESEARCH_COORDINATOR = "Chargé de la recherche";
    case FULL_PROFESSOR = "Professeur ordinaire";
    case ASSOCIATE_PROFESSOR = "Professeur associé";
    case ASSISTANT_PROFESSOR = "Professeur assistant";
    case LECTURER = "Chargé de cours";
    case HEAD_OF_DEPARTMENT = "Chef de département";
    case LAB_DIRECTOR = "Directeur de laboratoire";
}
