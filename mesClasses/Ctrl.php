<?php
require_once 'C_Users.php';

class Ctrl {
    private $users;

    public function __construct() {
        $this->users = new C_Users();
    }

    // Vérification de la connexion de l'utilisateur
    public function verifierConnexion($login, $password) {
        return $this->users->CheckLoginInfo($login, $password);
    }

    // Récupère et trie les visiteurs par nom
    public function getVisiteursTrie() {
        $users = $this->users->getAllUsers();
        usort($users, function($a, $b) {
            return strcmp($a->Nom(), $b->Nom());
        });
        return $users;
    }
}
?>
