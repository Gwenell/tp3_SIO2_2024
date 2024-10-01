<?php
require_once 'mesClasses/Cdao.php';

$dao = new Cdao();

// Récupérer le type de frais depuis le formulaire (ou 'ALL' par défaut)
$typeFrais = isset($_POST['idFraisForfait']) ? $_POST['idFraisForfait'] : 'ALL';

// Si "Tous" est sélectionné, on récupère tous les frais, sinon on filtre par type
if ($typeFrais === 'ALL') {
    $fraisForfaitaires = $dao->getTousFraisForfaitSortedByDate();
} else {
    $fraisForfaitaires = $dao->getFraisForfaitByTypeSortedByDate($typeFrais);
}

if (!empty($fraisForfaitaires)) {
    echo '<table class="min-w-full bg-white">';
    echo '<thead><tr class="w-full bg-gray-200"><th class="py-2 px-4 text-left">Type de Frais</th><th class="py-2 px-4 text-left">Montant</th><th class="py-2 px-4 text-left">Date</th></tr></thead>';
    echo '<tbody>';
    foreach ($fraisForfaitaires as $frais) {
        echo '<tr>';
        echo '<td class="border px-4 py-2">' . htmlspecialchars($frais['libelle']) . '</td>';
        echo '<td class="border px-4 py-2">' . htmlspecialchars($frais['montant']) . '</td>';
        echo '<td class="border px-4 py-2">' . htmlspecialchars($frais['date']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>Aucun frais forfaitaire disponible pour ce type.</p>';
}
