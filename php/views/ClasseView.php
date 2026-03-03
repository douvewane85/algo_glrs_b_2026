<?php 
require_once dirname(__DIR__) . "/entity/Enums.php";
require_once dirname(__DIR__) . "/entity/ClassePeda.php";
class ClasseView{
   private function __construct()
    {
        throw new \Exception('Not implemented');
    }
public static function saisieClasse(array $niveaux,array $filieres): ClassePeda {
     do{
        for($i=1;$i<=3;$i++){
            echo "$i- {$niveaux[$i]->value}\n";
        }
        echo "Veullez selectionner un niveau ";
        $indexSelectNiv = (int)readline();
     }
    while($indexSelectNiv<1 || $indexSelectNiv>3);
    $niveau=$niveaux[$indexSelectNiv];

     do{
        for($i=1;$i<=3;$i++){
            echo "$i- {$filieres[$i]->value}\n";
        }
        echo "Veullez selectionner une filiere ";
        $indexSelectFil = (int)readline();
     }
    while($indexSelectFil<1 || $indexSelectFil>3);  
    $filiere=$filieres[$indexSelectFil];
    $classe= new ClassePeda(null,$niveau, $filiere);
    return $classe;
}

public static function afficherAllClasse(array $allClasse,int $nbreClasse): void {
    for($i=1; $i<=$nbreClasse; $i++){
        echo $allClasse[$i]->toString() . "\n";
    }
}

}