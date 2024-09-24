<?php
require_once 'C_Users.php';

class Ctrl {
    private $users;

    public function __construct() {
        $this->users = new C_Users();
    }

    public function verifierConnexion($login, $password) {
        return $this->users->CheckLoginInfo($login, $password);
    }

    public function getVisiteursTrie() {
        $users = $this->users->getAllUsers();
        usort($users, function($a, $b) {
            return strcmp($a->Nom(), $b->Nom());
        });
        return $users;
    }
}