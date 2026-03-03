<?php 
enum Niveau: string {
    case L1 = 'L1';
    case L2 = 'L2';
    case L3 = 'L3';
}

enum Filiere:string{
    case MAE = 'MAE';
    case CDSD = 'CDSD';
    case GLRS = 'GLRS';
}

enum Statut:string{
    case Planifie = 'Planifié';
    case Encours = 'En cours';
    case Terminer = 'Terminé';
}