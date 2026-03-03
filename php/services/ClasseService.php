<?php 
require_once dirname(__DIR__) . "/entity/ClassePeda.php";

/*
 self:permet d'acceder aux membres statiques de la classe courante
 self=ClasseService
*/
class ClasseService{

    private static array $allClasse = [];
    private static int $nbreClasse = 0;

    private function __construct()
    {
        throw new \Exception('Not implemented');
    }

    public static function addClasse(ClassePeda $classePeda): bool {
        if(self::$nbreClasse<100){
           self::$nbreClasse++;
           self::$allClasse[self::$nbreClasse] = $classePeda;
           return true;
        }
        return false;
    }

    public static function getAllClasse(array &$allClasse): void {
        for($i=1; $i<=self::$nbreClasse; $i++){
            $allClasse[$i] = self::$allClasse[$i];
        }
    }

    public static function getNbreClasse(): int {
        return self::$nbreClasse;
    }

    public static function getClasseById(int $id): ?ClassePeda {
        for($i=1; $i<=self::$nbreClasse; $i++){
            if(self::$allClasse[$i]->getId() == $id){
                return self::$allClasse[$i];
            }
        }
        return null;
    }


}