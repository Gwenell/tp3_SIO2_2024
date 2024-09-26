<?php
session_start();
require_once 'mesClasses/Ctrl.php';
require_once 'mesClasses/Cdao.php';
require_once 'mesClasses/CficheFrais.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: seConnecter.php");
    exit();
}

$ctrl = new Ctrl();
$dao = new Cdao();
$idVisiteur = $_SESSION['id'];
$mois = date('Ym');

$ficheFrais = new CficheFrais($idVisiteur, $mois);

// Traitement du formulaire des frais forfaitaires
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitFF'])) {
    $idFraisForfait = $_POST['idFraisForfait'];
    $quantite = $_POST['quantite'];
    
    $ficheFrais->ajouterFraisForfait($idFraisForfait, $quantite);
    
    header("Location: saisirFicheFrais.php");
    exit();
}

// Traitement du formulaire des frais hors forfait
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitFHF'])) {
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
    $montant = $_POST['montant'];
    
    $ficheFrais->ajouterFraisHorsForfait($libelle, $date, $montant);
    
    header("Location: saisirFicheFrais.php");
    exit();
}

// Récupération des frais hors forfait
$fraisHorsForfait = $ficheFrais->getFraisHorsForfait();

$pageTitle = "Saisie Fiche Frais";
include 'includes/head.php';
?>

<body class="bg-gray-100">
    <?php include 'includes/navbar.php'; ?>

    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-4xl font-bold text-center mb-6 text-blue-600">Saisie Fiche de Frais</h1>

        <?php include 'includes/form_FF.php'; ?>
        <?php include 'includes/form_FHF.php'; ?>
        <?php include 'includes/afficheFHF.php'; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>