<?php
session_start();
require_once 'mesClasses/Cdao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $libelleFHF = $_POST['libelleFHF'];
    $montantFHF = $_POST['montantFHF'];
    
    // Connexion à la base de données et insertion
    $dao = new Cdao();
    $query = "INSERT INTO horsforfait (libelle, montant) VALUES (:libelle, :montant)";
    $dao->execute($query, ['libelle' => $libelleFHF, 'montant' => $montantFHF]);

    // Redirection après l'enregistrement
    header("Location: saisirFicheFrais.php");
    exit();
}
?>
