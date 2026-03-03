//Questions 
# Les Entites
  ## Enumerations
    type Niveau= "L1","L2","L3"
    type Filiere= "MAE","IAGE","GLRS"
    type Statut ="Planifie","Encours","Terminer"

  ## Tableaux
   const N=100
     type TabCours=tableau [1..N]Cours
     type TabClasse=tableau [1..N]ClassePeda
     type TabNiveau=tableau [1..3]Niveau
     type TabFiliere=tableau [1..3]Filiere
 ## Classe Entite 
  ### Classe 
    type ClassePeda =Classe
  Debut 
  ####  Attributs
       prive  id:entier
       prive  filiere:Filiere
       prive  niveau:Niveau
       prive static cpt:entier
       //ManyToMany ==> Proprietes Navigables
       
       prive cours:TabCours
       prive nbreCours:entier

      
   ####  methodes 
   public ClassePeda()
    Debut
       ClassePeda.cpt<-ClassePeda.cpte+1
       this.id=cpte
       this.nbreCours<--0
   Fin
 public ClassePeda(D filiere:Filiere niveau:Niveau)
    Debut
       ClassePeda.cpt<-ClassePeda.cpte+1
       this.id=cpte
       //Regles de validation
        this.setFiliere(filiere)
        this.setNiveau(niveau)
        this.nbreCours<--0

   Fin

   public fonction getNomClasse():chaine
   Debut
     retourner this.niveau ," ",this.filiere
   Fin

 public fonction toChaine():chaine
   Debut
     retourner "Nom: ", this.getNomClasse()," Niveau:", this.niveau, " Filiere:",this.filiere
   Fin

   //Les Cours d'une classe
   public procedure getCours(D/R allCours:TabCours)
    var 
      i:entier
   Debut
        pour(i<-1;i< this.nbreCours;i<-i+1) faire 
           allCours[i]<--this.cours[i]
        Fpour
   Fin 

   //Affecter un cours a une classe
   public fonction addCours(D cours:Cours):booleen
    var 
   Debut
        si(this.nbreCours<N)alors
          this.nbreCours<--this.nbreCours+1
          this.cours[ this.nbreCours]<--cours
          retourner Vrai
        sinon
          retourner Faux
        Fsi 
   Fin  

    public fonction getNbreCours():entier
    Debut
       retourner this.nbreCours
    Fin

 #####  Getters et Setters 


FinClasse


### Cours 
    type Cours =Classe
  Debut 
  ####  Attributs
       prive  id:entier
       prive  module:chaine
       prive  professeur:chaine
       prive static cpt:entier
       prive classes:TabClasse
       prive nbreClasse:entier
      
   ####  methodes 
   public Cours()
    Debut
       Cours.cpt<-Cours.cpte+1
       this.id=cpte
       this.nbreClasse<--0
   Fin
 public Cours(D module:chaine professeur:chaine)
    Debut
       Cours.cpt<-Cours.cpte+1
       this.id=cpte
       //Regles de validation
        this.setModule(module)
        this.setProfesseur(professeur)
        this.nbreClasse<--0

   Fin

  

  public fonction toChaine():chaine
   Debut
     retourner "Professeur: ", this.professeur," Module :", this.module
   Fin


//Les classes qui partagent le meme cours
   public procedure getClasses(D/R allClasse:TabClasse)
    var 
      i:entier
   Debut
        pour(i<-1;i< this.nbreClasse;i<-i+1) faire 
           allClasse[i]<--this.classes[i]
        Fpour
   Fin 

   //Ajouter une classe dans un cours
   public fonction addClasse(D classe:Cours):booleen
    var 
   Debut
        si(this.nbreCours<N)alors
          this.nbreClasse<--this.nbreClasse+1
          this.classes[ this.nbreClasse]<--classe
          retourner Vrai
        sinon
           retourner Faux
        Fsi 
   Fin  
   public fonction getNbreClasse():entier
    Debut
       retourner this.nbreClasse
    Fin

 #####  Getters et Setters 


FinClasse

# Les Services
Type ClasseService=Classe
Debut
     //Contient toutes les classes
       prive  static classes:TabClasse
       prive  static nbreClasse:entier
  prive ClasseService
  Debut
   Fin
   public static procedure getClasses(D/R allClasse:TabClasse)
    var 
      i:entier
   Debut
        pour(i<-1;i< ClasseService.nbreClasse;i<-i+1) faire 
           allClasse[i]<--ClasseService.classes[i]
        Fpour
   Fin 

   //Ajouter une classe dans un cours
   public static fonction addClasse(D classe:Cours):booleen
    var 
   Debut
        si(this.nbreCours<N)alors
          ClasseService.nbreClasse<--ClasseService.nbreClasse+1
          ClasseService.classes[ClasseService.nbreClasse]<--classe
          retourner Vrai
        sinon
           retourner Faux
        Fsi 
   Fin  
   public static fonction getNbreClasse():entier
    Debut
       retourner ClasseService.nbreClasse
    Fin
  Fin

FinClasse

Type CoursService=Classe
Debut
   prive static cours:TabCours
   prive static nbreCours:entier
 prive CoursService
  Debut
   Fin

   //Toutes les  Cours de l'ecole
   public static procedure getCours(D/R allCours:TabCours)
    var 
      i:entier
   Debut
        pour(i<-1;i< CoursService.nbreCours;i<-i+1) faire 
           allCours[i]<--CoursService.cours[i]
        Fpour
   Fin 

   //Ajouter  un cours a l'ecole
   public static fonction addCours(D cours:Cours):booleen
    var 
   Debut
        si(CoursService.nbreCours<N)alors
          CoursService.nbreCours<--CoursService.nbreCours+1
          CoursService.cours[CoursService.nbreCours]<--cours
          retourner Vrai
        sinon
          retourner Faux
        Fsi 
   Fin  

    public static fonction getNbreCours():entier
    Debut
       retourner CoursService.nbreCours
    Fin
FinClasse
# Les Views
type ClasseView =classe
Debut 
  prive ClasseView
  Debut
   
  Fin
  public fonction saisieClasse(D niveaux:TabNiveau,filieres:TabFiliere):ClassePeda
  var 
  i,indexSelectNiv,indexSelectFil:entier
  classe:ClassePeda

  Debut 
     faire
        pour(i<-1;i<=3;i<--i+1) faire
          Ecrire(i,"-" niveaux[i])
        Fpour
        Ecrire("Veullez selectionner un niveau ")
        lire(indexSelectNiv)
    tanque(indexSelectNiv<0 ou indexSelectNiv>3)

  faire
        pour(i<-1;i<=3;i<--i+1) faire
          Ecrire(i,"-" filieres[i])
        Fpour
        Ecrire("Veullez selectionner une Filiere ")
        lire(indexSelectFil)
    tanque(indexSelectFil<0 ou indexSelectFil>3)

      classe<--new ClassePeda(filieres[indexSelectFil],niveaux[indexSelectNiv])
      return  classe
  Fin
Fin

  public procedure afficheClasses(D classes:TabClasses nbreClasse:entier)
   i:entier
   Debut
        pour(i<-1;i<=nbreClasse;i<--i+1) faire
          Ecrire(i,"-" classes[i].toChaine())
        Fpour
    Fin

  FinClasse

type CoursView =classe
Debut 
  prive CoursView
  Debut
   
  Fin
  public fonction saisieCours(D classes:TabClasse,nbreClasse:entier):Cours
  var 
  i,indexSelectClasse:entier
  cours:Cours
  professeur,module:chaine
  rep:caractere
  Debut 
        faire
            Ecrire("Entrer le Professeur")
            lire(professeur)
        tanque(professeur="")
        faire
            Ecrire("Entrer le Module")
            lire(module)
        tanque(module="")
        //Plusieurs classe
        (1)faire
            faire
                pour(i<-1;i<=nbreClasse;i<--i+1) faire
                Ecrire(i,"-" classes[i].toChaine())
                Fpour
                Ecrire("Veullez selectionner une Classe ")
                lire(indexSelectClasse)
            tanque(indexSelectClasse<0 ou indexSelectClasse>nbreClasse)
                cours<--new Cours(module,professeur)
                //Relation Unidirectionnel (cours -->classe )
                cours.addClasse(classes[indexSelectClasse])
                //Relation Unidirectionnel (classe -->cours )
                classes[indexSelectClasse].addCours(cours)
                Ecrire("Voulez ajouter une autre classe (O/N)")
                lire(rep)
        (1)FinTanque(rep='O')
        retourner cours
  Fin


  public procedure afficheClasses(D classes:TabClasses nbreClasse:entier)
   i:entier
   Debut
        pour(i<-1;i<=nbreClasse;i<--i+1) faire
          Ecrire(i,"-" classes[i].toChaine())
        Fpour
    Fin

  FinClasse
# Les Classe Principals

Type Principal =classe

public Principal()
   Debut
   Fin
public static procedure  main()
  var 
   classe:ClassePeda
   niveaux:TabNiveau
   filieres:TabFiliere
   resultAdd:booleen
   allClasses:TabClasse
   Debut
       niveaux[1]="L1"        niveaux[2]="L2"        niveaux[3]="L3" 
       filieres[1]="MAE"      filieres[2]="GLRS".   filieres[1]="IAGE"
      cas 1 : 
          classe<--ClasseView.saisieClasse(niveaux,filieres)
          resultAdd<--ClasseService.addClasse(classe)
          si( resultAdd=Vrai) alors
             Ecrire("Classe ajoutee avec success")
          sinon
               Ecrire("Erreur Ajout")
          Fsi
      cas 2 : 
     
          ClasseService.getClasses(allClasse)
          ClasseView.afficheClasses(allClasse,ClasseService.getNbreClasse())
        
   Fin

FinClasse