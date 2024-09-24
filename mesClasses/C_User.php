<?php
/**
 * Classe représentant un utilisateur (visiteur) dans le système
 */
class C_User {
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $mdp;
    private $adresse;
    private $cp;
    private $ville;
    private $dateEmbauche;  

    /**
     * Constructeur de la classe C_User
     */
    public function __construct($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmbauche){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->dateEmbauche = $dateEmbauche;
    }
    private $hashed_md; // Add a new private property for hashed password

    // Getters pour tous les attributs
    public function Id() { return $this->id; }
    public function Nom() { return $this->nom; }
    public function Prenom() { return $this->prenom; }
    public function Login() { return $this->login; }
    public function Mdp() { return $this->mdp; }
    public function HashedMd() { return $this->hashed_md; }
    public function Adresse() { return $this->adresse; }
    public function Cp() { return $this->cp; }
    public function Ville() { return $this->ville; }
    public function DateEmbauche() { return $this->dateEmbauche; }
}