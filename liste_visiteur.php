<?php
require_once 'mesClasses/Ctrl.php';
//require_once 'includes/navbar.php'; // Inclusion de la barre de navigation

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

<body class="bg-gray-100">
    <?php include 'includes/navbar.php'; ?>

    <!-- Removed the duplicate header to avoid double blue bars -->
    <!-- <h1 class="text-4xl font-bold text-center mb-6 text-blue-600">Liste des Visiteurs</h1> -->

    <!-- Formulaire de filtrage -->
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-4xl font-bold text-center mb-6 text-blue-600">Liste des Visiteurs</h1>

        <form class="mb-6" method="POST" action="">
            <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Filtrage par ville -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ville">
                        Choisir la ville
                    </label>
                    <div class="relative">
                        <select name="ville" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="toutes" <?= $ville === 'toutes' ? 'selected' : '' ?>>Toutes les villes</option>
                            <?php foreach ($visiteurs as $visiteur) : ?>
                                <option value="<?= $visiteur->Ville() ?>" <?= $ville === $visiteur->Ville() ? 'selected' : '' ?>><?= $visiteur->Ville() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Filtrage par nom -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="partieNom">
                        Nom (Partie)
                    </label>
                    <input name="partieNom" value="<?= $partieNom ?>" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="partieNom" type="text" placeholder="Nom...">
                </div>

                <!-- Filtrage par début ou fin du nom -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="debutFin">
                        Début ou Fin
                    </label>
                    <div class="relative">
                        <select name="debutFin" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="debut" <?= $debutFin === 'debut' ? 'selected' : '' ?>>Début</option>
                            <option value="fin" <?= $debutFin === 'fin' ? 'selected' : '' ?>>Fin</option>
                            <option value="contient" <?= $debutFin === 'contient' ? 'selected' : '' ?>>Contient</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Filtrer
                </button>
            </div>
        </form>

        <!-- Affichage de la liste des visiteurs -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-3 bg-gray-100 border-b">Nom</th>
                        <th class="py-2 px-3 bg-gray-100 border-b">Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visiteursFiltres as $visiteur) : ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $visiteur->Nom() ?></td>
                            <td class="border px-4 py-2"><?= $visiteur->Ville() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
