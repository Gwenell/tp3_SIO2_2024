<?php
/**
 * Classe représentant un utilisateur (visiteur) dans le système
 */
class C_User {
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $hash_password;  // Utilisation de hash_password au lieu de mdp
    private $adresse;
    private $cp;
    private $ville;
    private $dateEmbauche;  

    /**
     * Constructeur de la classe C_User
     */
    public function __construct($id, $nom, $prenom, $login, $hash_password, $adresse, $cp, $ville, $dateEmbauche){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->hash_password = $hash_password;  // Stocke le mot de passe haché
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->dateEmbauche = $dateEmbauche;
    }

    // Getters pour tous les attributs
    public function Id() { return $this->id; }
    public function Nom() { return $this->nom; }
    public function Prenom() { return $this->prenom; }
    public function Login() { return $this->login; }
    public function HashPassword() { return $this->hash_password; } // Utilise le mot de passe haché
    public function Adresse() { return $this->adresse; }
    public function Cp() { return $this->cp; }
    public function Ville() { return $this->ville; }
    public function DateEmbauche() { return $this->dateEmbauche; }
}
?>
