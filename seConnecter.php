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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['id'])) {
    header("Location: liste_visiteur.php");
    exit();
}

$ctrl = new Ctrl();

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = $ctrl->verifierConnexion($login, $password);
    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $user->Id();
        $_SESSION['prenom'] = $user->Prenom(); // Ajout du prénom à la session
        if (!isset($_SESSION['id'])) {
            error_log("L'ID de l'utilisateur n'a pas pu être stocké dans la session.");
            $error = "Erreur lors de la connexion. Veuillez réessayer.";
        } else {
            header("Location: liste_visiteur.php");
            exit();
        }
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

<body style="background-color: #000000; color: #ffffff;">
    <!-- Ton contenu -->
</body>
