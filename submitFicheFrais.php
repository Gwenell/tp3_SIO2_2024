<?php
session_start();
require_once 'mesClasses/Cdao.php';
require_once 'mesClasses/CficheFrais.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idVisiteur = $_SESSION['idVisiteur'];
    $mois = date('Ym');
    $montantFF = $_POST['montantFF'];
    $idFraisForfait = $_POST['idFraisForfait'];

    $dao = new Cdao();
    $ficheFrais = new CficheFrais($idVisiteur, $mois);
    
    // Vérifier ou insérer la fiche de frais
    $ficheFrais->insertFicheFrais($dao);

    // Ajouter les frais forfaitaires
    $ficheFrais->ajouterFraisForfait($dao, $idFraisForfait, $montantFF);

    header("Location: saisirFicheFrais.php");
    exit();
}
