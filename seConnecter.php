<?php
require_once 'mesClasses/Ctrl.php';

session_start();

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: seConnecter.php");
    exit();
}

// Redirection si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: liste_visiteur.php");
    exit();
}

$ctrl = new Ctrl();

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($ctrl->verifierConnexion($login, $password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login'] = $login;
        header("Location: liste_visiteur.php");
        exit();
    } else {
        $error = "Login ou mot de passe incorrect";
    }
}

$pageTitle = "Connexion";
include 'includes/head.php';
?>

<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-4">Connexion</h2>
    <?php 
    if(isset($error)) {
        include 'includes/gestion-erreur.php';
        afficherErreur($error);
    }
    include 'includes/form_login.php';
    ?>
</div>

<?php include 'includes/footer.php'; ?>