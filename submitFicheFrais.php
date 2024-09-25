<?php
session_start();
require_once 'mesClasses/Cdao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montantFF = $_POST['montantFF'];
    $idVisiteur = $_SESSION['idVisiteur'];
    $mois = date('Ym');

    $dao = new Cdao();
    $query = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
              VALUES (:idVisiteur, :mois, 'ETP', :quantite)";
    $dao->execute($query, ['idVisiteur' => $idVisiteur, 'mois' => $mois, 'quantite' => $montantFF]);

    header("Location: saisirFicheFrais.php");
    exit();
}
