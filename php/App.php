<?php 
require_once __DIR__ . "/entity/Enums.php";
require_once __DIR__ . "/entity/ClassePeda.php";
require_once __DIR__ . "/entity/Cours.php";
require_once __DIR__ . "/services/ClasseService.php";
require_once __DIR__ . "/services/CoursService.php";
require_once __DIR__ . "/views/ClasseView.php";
require_once __DIR__ . "/views/CoursView.php";
class App{
    private function __construct()
    {
        throw new \Exception('Not implemented');
    }
    public static function main(): void {
         $niveaux = [1 => Niveau::L1, 2 => Niveau::L2, 3 => Niveau::L3];
        $filieres = [1 => Filiere::MAE, 2 => Filiere::CDSD, 3 => Filiere::GLRS];
        do {
            $option = self::menu();
            switch ($option) {
                case 1:
                    echo "Création d'une classe\n";
                       
                        $classePeda = ClasseView::saisieClasse($niveaux, $filieres);
                        $result = ClasseService::addClasse($classePeda);
                        if ($result==true) {
                            echo "Classe créée avec succès !\n";
                        } else {
                            echo "Erreur lors de la création de la classe !\n";
                        }
                    break;
                case 2:
                    echo "Liste de toutes les classes\n";
                    $allClasse = [];
                    ClasseService::getAllClasse($allClasse);
                    $nbreClasse = ClasseService::getNbreClasse();
                    if ($nbreClasse == 0) {
                        echo "Aucune classe trouvée !\n";
                    } else {
                        ClasseView::afficherAllClasse($allClasse, $nbreClasse);
                    }
                    break;
                case 3:
                    echo "Création d'un cours\n";
                    $allClasse = [];
                    ClasseService::getAllClasse($allClasse);
                    $nbreClasse = ClasseService::getNbreClasse();
                    if ($nbreClasse == 0) {
                        echo "Aucune classe trouvée ! Impossible de créer un cours sans classe.\n";
                    } else {
                        $cours = CoursView::saisieCours($allClasse, $nbreClasse);
                        $result = CoursService::addCours($cours);
                        if ($result==true) {
                            echo "Cours créé avec succès !\n";
                        } else {
                            echo "Erreur lors de la création du cours !\n";
                        }
                    }
                    break;
                case 4:
                    echo "Liste des cours\n";
                    $allCours = [];
                    CoursService::getAllCours($allCours);
                    $nbreCours = CoursService::getNbreCours();
                    if ($nbreCours == 0) {
                        echo "Aucun cours trouvé !\n";
                    } else {
                        CoursView::afficherAllCours($allCours, $nbreCours);
                    }
                    break;
                case 5:
                    echo "Liste des cours d'une classe\n";
                    $idClasse = (int)readline("Veullez saisir l'id de la classe : ");
                    $classe = ClasseService::getClasseById($idClasse);
                    if ($classe == null) {
                        echo "Classe non trouvée !\n";
                    } else {
                           $nbreCours = $classe->getNbreCours();
                            if ($nbreCours == 0) {
                                echo "Aucun cours trouvé pour cette classe !\n";    
                            } else {
                                 $allCours = [];
                                 $classe->getCours($allCours);
                                CoursView::afficherAllCours($allCours, $nbreCours);
                            }
                    }
                    break;
                case 6:
                    echo "Liste des classes d'un cours\n";
                    $idCours = (int)readline("Veullez saisir l'id du cours : ");
                    $cours = CoursService::getCoursById($idCours);
                    if ($cours == null) {
                        echo "Cours non trouvé !\n";
                    } else {
                           $nbreClasse = $cours->getNbreClassesPeda();
                            if ($nbreClasse == 0) {
                                echo "Aucune classe trouvée pour ce cours !\n";
                            } else {
                                $allClasse = [];
                                $cours->getClassesPeda($allClasse);
                                ClasseView::afficherAllClasse($allClasse, $nbreClasse);
                            }
                    }
                    break;
                case 7:
                    echo "Au revoir !\n";
                    exit(0);
            }
        } while (true);
    }

    public static function menu(): string  {
        echo "1- Creer Classe\n";
        echo "2- Lister toutes les  Classe\n";
        echo "3- Creer Cours\n";
        echo "4- Lister tous les cours\n";
        echo "5- Lister  les cours d'une classe\n";
        echo "6- Lister  les classes d'un cours\n";
        echo "7- Quitter\n";
        echo "Veullez selectionner une option : ";
        $option = readline();
        return $option;
    }
}

App::main();