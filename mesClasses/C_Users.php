<?php
require_once 'C_User.php';
require_once 'Cdao.php';

class C_Users {
    private $tabUsers;

    public function __construct(){
        $odao = new Cdao();
        $query = "SELECT * FROM visiteur";
        $tabUser = $odao->getTabDataFromSql($query);

        foreach($tabUser as $i){
            $this->tabUsers[] = new C_User(
                $i['id'],
                $i['nom'],
                $i['prenom'],
                $i['login'],
                $i['mdp'],
                $i['adresse'],
                $i['cp'],
                $i['ville'],
                $i['dateEmbauche']);
        }
    }

    public function CheckLoginInfo($gLogin, $gMdp){
        foreach($this->tabUsers as $user){
            
            // Compare the password with the hashed password in the 'hashed_mdp' field
            if ($user->Login() == $gLogin && password_verify($gMdp, $user->HashedMd())) 
             {
                return true;
            }
        }
        return false;
    }

    public function getAllUsers() {
        return $this->tabUsers;
    }
}