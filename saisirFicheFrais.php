<?php
require_once('navbar.php'); // Inclusion de la navBar
?>

<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">Saisir Fiche de Frais</h1>

    <!-- Formulaire pour les frais forfaitaires -->
    <?php require_once('form_FF.php'); ?>

    <!-- Formulaire pour les frais hors forfait -->
    <?php require_once('form_FHF.php'); ?>
</div>
