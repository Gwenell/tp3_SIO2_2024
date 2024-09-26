<?php
require_once 'C_User.php';
require_once 'Cdao.php';

class C_Users {
    private $tabUsers = [];

    public function __construct(){
        $odao = new Cdao();
        // Récupération des utilisateurs avec leur mot de passe haché
        $query = "SELECT * FROM visiteur";
        $tabUser = $odao->getTabDataFromSql($query);

        foreach($tabUser as $i){
            $this->tabUsers[] = new C_User(
                $i['id'],
                $i['nom'],
                $i['prenom'],
                $i['login'],
                $i['hash_password'],
                $i['adresse'],
                $i['cp'],
                $i['ville'],
                $i['dateEmbauche']);
        }
    }

    // Vérification du login et du mot de passe haché
    public function CheckLoginInfo($gLogin, $gMdp){
        foreach($this->tabUsers as $user){
            // Compare le mot de passe saisi avec le mot de passe haché
            if ($user->Login() == $gLogin && password_verify($gMdp, $user->HashPassword())) {
                return $user;  // Retourne l'objet utilisateur complet
            }
        }
        return null;
    }

    // Récupère tous les utilisateurs
    public function getAllUsers() {
        return $this->tabUsers;
    }
}
