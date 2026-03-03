<?php 
require_once dirname(__DIR__) . "/entity/Cours.php";
class CoursService{

    private static array $allCours = [];
    private static int $nbreCours = 0;


    private function __construct()
    {
        throw new \Exception('Not implemented');
    }
    public static function addCours(Cours $cours): bool {
        if(self::$nbreCours<100){       
            self::$nbreCours++;
            self::$allCours[self::$nbreCours] = $cours;
            return true;
        }
            return false;
    }

    public static function getAllCours(array &$allCours): void {
        for($i=1; $i<=self::$nbreCours; $i++){
            $allCours[$i] = self::$allCours[$i];
        }
    }

    public static function getNbreCours(): int {
        return self::$nbreCours;
    }

    public static function getCoursById(int $id): ?Cours {
        for($i=1; $i<=self::$nbreCours; $i++){
            if(self::$allCours[$i]->getId() == $id){
                return self::$allCours[$i];
            }
        }
        return null;
    }
}