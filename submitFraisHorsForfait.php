<?php
session_start();
require_once 'mesClasses/Cdao.php';
require_once 'mesClasses/CficheFrais.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idVisiteur = $_SESSION['idVisiteur'];
    $mois = date('Ym');
    $libelleFHF = $_POST['libelleFHF'];
    $montantFHF = $_POST['montantFHF'];

    $dao = new Cdao();
    $ficheFrais = new CficheFrais($idVisiteur, $mois);
    
    // Vérifier ou insérer la fiche de frais
    $ficheFrais->insertFicheFrais($dao);

    // Ajouter les frais hors forfait
    $ficheFrais->ajouterFraisHorsForfait($dao, $libelleFHF, $montantFHF);

    header("Location: saisirFicheFrais.php");
    exit();
}
