<?php 
require_once dirname(__DIR__) . "/entity/Enums.php";


class Cours{
    private int $id;
    private string $module;
    private string $professeur;
    private Statut $statut;
    private static int $cpt = 0;

    //Propriete Navigable ManyToMany
    private array $classesPeda = [];
    private int $nbreClassesPeda = 0;


    public function __construct(int|null $id=null, ?string $module=null, ?string $professeur=null, ?Statut $statut=null) {
        $this->id = $id ?? self::$cpt++;
        $this->module = $module;
        $this->professeur = $professeur;
        $this->statut = $statut??Statut::Planifie;
        $this->nbreClassesPeda = 0;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getModule(): string {
        return $this->module;
    }

    public function getProfesseur(): string {
        return $this->professeur;
    }

   

    public function getStatut(): Statut {
        return $this->statut;
    }

        public function getClassesPeda(array &$allClasse): void {
            for($i=1; $i<=$this->nbreClassesPeda; $i++){
               $allClasse[$i] = $this->classesPeda[$i];
            }
        }
        public function addClassePeda(ClassePeda $classePeda): void {
            $this->nbreClassesPeda++;
            $this->classesPeda[$this->nbreClassesPeda] = $classePeda;
        }

        public function getNbreClassesPeda(): int {
            return $this->nbreClassesPeda;
        }


    public function setStatut(Statut $statut): void {
        $this->statut = $statut;
    }
    public function setModule(string $module): void {
        $this->module = $module;
    }
    public function setProfesseur(string $professeur): void {
        $this->professeur = $professeur;
    }

    
    public function toString()
    {
        return "Id=" . $this->id . ", Module=" . $this->module . ", Professeur=" . $this->professeur . ", Statut=" . $this->statut->value ;
    }
}