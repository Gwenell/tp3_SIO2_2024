<?php
// Inclusion du fichier pour la base de données
require_once('mesClasses/Cdao.php');

// Créer une instance de Cdao pour accéder à la base de données
$dao = new Cdao();

// Requête pour récupérer les utilisateurs
$requete = "SELECT id, mdp FROM visiteur";
$utilisateurs = $dao->getTabDataFromSql($requete);

foreach ($utilisateurs as $utilisateur) {
    $id = $utilisateur['id'];
    $motDePasse = $utilisateur['mdp'];
    
    // Hachage du mot de passe en clair
    $motDePasseHache = password_hash($motDePasse, PASSWORD_BCRYPT);
    
    // Mise à jour du mot de passe haché dans la base de données
    $updateQuery = "UPDATE visiteur SET hash_password = :hash_password WHERE id = :id";
    $params = [
        ':hash_password' => $motDePasseHache,
        ':id' => $id
    ];
    $dao->execute($updateQuery, $params);
}

echo "Tous les mots de passe hachés ont été réinitialisés avec succès.";
?>
