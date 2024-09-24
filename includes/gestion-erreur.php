<?php
/**
 * Affiche un message d'erreur stylisé
 */
function afficherErreur($message) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>";
    echo "<strong class='font-bold'>Erreur!</strong>";
    echo "<span class='block sm:inline'> $message</span>";
    echo "</div>";
}