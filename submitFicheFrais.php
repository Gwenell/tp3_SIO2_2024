<?php
session_start();
require_once 'mesClasses/Cdao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $montantFF = $_POST['montantFF'];
    
    // Connexion à la base de données et insertion
    $dao = new Cdao();
    $query = "INSERT INTO fichefrais (montant, type) VALUES (:montant, 'forfaitaire')";
    $dao->execute($query, ['montant' => $montantFF]);

    // Redirection après l'enregistrement
    header("Location: saisirFicheFrais.php");
    exit();
}
?>
