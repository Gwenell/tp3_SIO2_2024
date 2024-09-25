<?php
session_start();
require_once 'mesClasses/Cdao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libelleFHF = $_POST['libelleFHF'];
    $montantFHF = $_POST['montantFHF'];
    $idVisiteur = $_SESSION['idVisiteur'];
    $mois = date('Ym');

    $dao = new Cdao();
    $query = "INSERT INTO lignefraishorsforfait (idVisiteur, mois, libelle, montant, date)
              VALUES (:idVisiteur, :mois, :libelle, :montant, NOW())";
    $dao->execute($query, ['idVisiteur' => $idVisiteur, 'mois' => $mois, 'libelle' => $libelleFHF, 'montant' => $montantFHF]);

    header("Location: saisirFicheFrais.php");
    exit();
}
