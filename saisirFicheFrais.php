<?php
session_start();
require_once 'includes/navbar.php'; // Inclusion de la barre de navigation
require_once 'mesClasses/Cdao.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: seConnecter.php");
    exit();
}

$dao = new Cdao();
$query = "SELECT * FROM lignefraishorsforfait WHERE idVisiteur = :idVisiteur";
$fraisHorsForfait = $dao->getTabDataFromSql($query, ['idVisiteur' => $_SESSION['idVisiteur']]);

$pageTitle = "Fiche Frais";
include 'includes/head.php';
?>

<div class="container mx-auto mt-8 px-4">
    <h1 class="text-4xl font-bold text-center mb-6 text-blue-600">Saisie Fiche de Frais</h1>

    <!-- Formulaire frais forfaitaires -->
    <section class="mb-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Frais Forfaitaires</h2>
        <form action="submitFicheFrais.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="montantFF">Montant des frais forfaitaires</label>
                <input type="number" id="montantFF" name="montantFF" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer
            </button>
        </form>
    </section>

    <!-- Formulaire frais hors forfait -->
    <section class="mb-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Frais Hors Forfait</h2>
        <form action="submitFraisHorsForfait.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="libelleFHF">Libellé du frais hors forfait</label>
                <input type="text" id="libelleFHF" name="libelleFHF" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="montantFHF">Montant des frais hors forfait</label>
                <input type="number" id="montantFHF" name="montantFHF" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer
            </button>
        </form>
    </section>

    <!-- Affichage des frais hors forfait -->
    <section class="p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Liste des Frais Hors Forfait</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">Libellé</th>
                    <th class="py-3 px-4 text-left">Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fraisHorsForfait)) : ?>
                    <?php foreach ($fraisHorsForfait as $frais): ?>
                        <tr class="border-t border-gray-300">
                            <td class="py-3 px-4"><?php echo htmlspecialchars($frais['date']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($frais['libelle']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($frais['montant']); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-center">Aucun frais hors forfait enregistré</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>
