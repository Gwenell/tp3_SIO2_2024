<?php
session_start();
require_once 'mesClasses/Ctrl.php';
require_once 'mesClasses/Cdao.php';
require_once 'mesClasses/CficheFrais.php';

// Vérification si l'utilisateur est connecté et si l'ID est défini
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['id'])) {
    header("Location: seConnecter.php");
    exit();
}

$ctrl = new Ctrl();
$dao = new Cdao();
$idVisiteur = $_SESSION['id'];
$mois = date('Ym');

// Vérification supplémentaire de l'ID
if (empty($idVisiteur)) {
    error_log("L'ID de l'utilisateur est vide dans saisirFicheFrais.php");
    header("Location: seConnecter.php");
    exit();
}

$ficheFrais = new CficheFrais($idVisiteur, $mois);

// Traitement du formulaire des frais forfaitaires
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitFF'])) {
    $idFraisForfait = $_POST['idFraisForfait'];
    $quantite = (int)$_POST['quantite']; // Assurez-vous que la quantité est un entier

    // Vérification de l'existence du frais forfaitaire dans la base
    $fraisForfaitExists = $dao->verifierFraisForfait($idFraisForfait);
    if ($fraisForfaitExists && $quantite > 0) {
        $ficheFrais->ajouterFraisForfait($idFraisForfait, $quantite);
    }
    
    header("Location: saisirFicheFrais.php");
    exit();
}

// Traitement du formulaire des frais hors forfait
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitFHF'])) {
    $libelle = htmlspecialchars($_POST['libelle']); // Protection contre les failles XSS
    $date = $_POST['date'];
    $montant = (float)$_POST['montant']; // Assurez-vous que le montant est un float

    // Validation de la date et du montant
    if (strtotime($date) && $montant > 0) {
        $ficheFrais->ajouterFraisHorsForfait($libelle, $date, $montant);
    }
    
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
