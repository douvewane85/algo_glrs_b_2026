<?php
require_once dirname(__DIR__) . "/entity/Cours.php";
class CoursView{
    private function __construct()
    {
        throw new \Exception('Not implemented');
    }
    public static function saisieCours(array $allClasse,int $nbreClasse): Cours {
        do {
           echo "Veullez saisir le Professeur : ";
           $professeur = readline();
        } while ($professeur == null || $professeur == "");
       
        do {
            echo "Veullez saisir le Module : ";
            $module = readline();
        } while ($module == null || $module == "");
       
     $cours=new Cours(null,$professeur, $module);
      do {
         do {
              for($i = 1; $i <= $nbreClasse; $i++) {
                  echo "$i- {$allClasse[$i]->toString()}\n";
              }
              echo "Veullez selectionner une classe pour le cours : ";
              $indexSelectClasse = (int)readline();
          } while ($indexSelectClasse < 1 || $indexSelectClasse > $nbreClasse);
          $classe=$allClasse[$indexSelectClasse];
          //Liaison entre le cours et la classe
           $cours->addClassePeda($classe);
          //Liaison entre la classe et le cours
           $classe->addCours($cours);
        $reponse = readline("Voulez-vous ajouter un autre cours ? (1 pour oui, 0 pour non) : ");
        $a = (int)$reponse;
      } while ( $a == 1);

     return $cours;
    }

    public static function afficherAllCours(array $allCours,int $nbreCours): void {
        for($i=1; $i<=$nbreCours; $i++){
            echo $allCours[$i]->toString() . "\n";
        }
    }
}