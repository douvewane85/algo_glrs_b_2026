<?php 
require_once dirname(__DIR__) . "/entity/Enums.php";
class ClassePeda {
    private int $id;
    private Niveau $niveau;
    private Filiere $filiere;
    private static int $cpt = 0;

    //Propriete Navigable ManyToMany
    private array $cours = [];
    private int $nbreCours = 0;

    /*
       if($id==null){
            $this->id = self::$cpt++;  // auto-increment insertion
        }else{
            $this->id = $id; //selection ou modification
        }
    
    */
    public function __construct(int|null $id=null, ?Niveau $niveau=null, ?Filiere $filiere=null) {
        $this->id = $id ?? self::$cpt++;
        $this->niveau = $niveau;
        $this->filiere = $filiere;
        $this->nbreCours = 0;

    }

    public function getId(): int {
        return $this->id;
    }

      public function getNomClasse(): string {  
          return $this->niveau->value . " " . $this->filiere->value;
      }

    public function getNiveau(): Niveau {
        return $this->niveau;
    }

    public function getFiliere(): Filiere {
        return $this->filiere;
    }
    public function getCours(array &$allCours): void {
        for($i=1; $i<=$this->nbreCours; $i++){
           $allCours[$i] = $this->cours[$i];
        }
    }
    public function addCours(Cours $cours): void {
        $this->nbreCours++;
        $this->cours[$this->nbreCours] = $cours;
    }
    public function getNbreCours(): int {
        return $this->nbreCours;
    }
   
    public function toString()
    {
        return "Nom :" . $this->getNomClasse() . ", Id=" . $this->id . ", Niveau=" . $this->niveau->value . ", Filiere=" . $this->filiere->value ;
    }
}