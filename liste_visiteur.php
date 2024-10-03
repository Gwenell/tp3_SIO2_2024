<?php
require_once 'mesClasses/Ctrl.php';

session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: seConnecter.php");
    exit();
}

$ctrl = new Ctrl();
$visiteurs = $ctrl->getVisiteursTrie();

// Gestion du filtrage
$ville = $_POST['ville'] ?? 'toutes';
$partieNom = $_POST['partieNom'] ?? '';
$debutFin = $_POST['debutFin'] ?? 'debut';

// Filtrer les résultats en fonction des critères
$visiteursFiltres = array_filter($visiteurs, function($user) use ($ville, $partieNom, $debutFin) {
    $villeMatch = ($ville === 'toutes') || (stripos($user->Ville(), $ville) !== false);
    $nomMatch = true;

    if ($partieNom) {
        if ($debutFin === 'debut') {
            $nomMatch = stripos($user->Nom(), $partieNom) === 0;
        } elseif ($debutFin === 'fin') {
            $nomMatch = substr_compare($user->Nom(), $partieNom, -strlen($partieNom)) === 0;
        } else {
            $nomMatch = stripos($user->Nom(), $partieNom) !== false;
        }
    }

    return $villeMatch && $nomMatch;
});

$pageTitle = "Liste des visiteurs";
include 'includes/head.php';
?>

<!-- Style ajouté pour forcer le fond noir -->
<body style="background-color: #000000; color: #ffffff;">
    <?php include 'includes/navbar.php'; ?>

    <!-- Titre principal -->
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-4xl font-bold text-center mb-6 text-blue-500">Liste des Visiteurs</h1>

        <!-- Formulaire de filtrage -->
        <form class="mb-6" method="POST" action="">
            <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Filtrage par ville -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-purple-500 text-sm font-bold mb-2" for="ville">
                        Choisir la ville
                    </label>
                    <div class="relative">
                        <select name="ville" class="block w-full p-2 border border-gray-600 bg-gray-900 text-white rounded leading-tight focus:outline-none">
                            <option value="toutes" <?= $ville === 'toutes' ? 'selected' : '' ?>>Toutes les villes</option>
                            <?php foreach ($visiteurs as $visiteur) : ?>
                                <option value="<?= $visiteur->Ville() ?>" <?= $ville === $visiteur->Ville() ? 'selected' : '' ?>><?= $visiteur->Ville() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Filtrage par nom -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-purple-500 text-sm font-bold mb-2" for="partieNom">
                        Nom (Partie)
                    </label>
                    <input name="partieNom" value="<?= $partieNom ?>" class="block w-full p-2 border border-gray-600 bg-gray-900 text-white rounded leading-tight focus:outline-none" id="partieNom" type="text" placeholder="Nom...">
                </div>

                <!-- Filtrage par début ou fin du nom -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-purple-500 text-sm font-bold mb-2" for="debutFin">
                        Début ou Fin
                    </label>
                    <div class="relative">
                        <select name="debutFin" class="block w-full p-2 border border-gray-600 bg-gray-900 text-white rounded leading-tight focus:outline-none">
                            <option value="debut" <?= $debutFin === 'debut' ? 'selected' : '' ?>>Début</option>
                            <option value="fin" <?= $debutFin === 'fin' ? 'selected' : '' ?>>Fin</option>
                            <option value="contient" <?= $debutFin === 'contient' ? 'selected' : '' ?>>Contient</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Filtrer
                </button>
            </div>
        </form>

        <!-- Affichage de la liste des visiteurs -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-900 text-white border border-gray-600 rounded-lg" style="border-radius: 8px;">
                <thead>
                    <tr class="bg-gray-800 text-purple-500">
                        <th class="py-3 px-4 text-left">Nom</th>
                        <th class="py-3 px-4 text-left">Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($visiteursFiltres) > 0) : ?>
                        <?php foreach ($visiteursFiltres as $visiteur) : ?>
                            <tr class="border-b border-gray-600">
                                <td class="py-2 px-4 bg-gray-900"><?= $visiteur->Nom() ?></td>
                                <td class="py-2 px-4 bg-gray-900"><?= $visiteur->Ville() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">Aucun visiteur trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
