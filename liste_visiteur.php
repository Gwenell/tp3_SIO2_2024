<?php
require_once 'mesClasses/Ctrl.php';
require_once 'includes/navbar.php'; // Inclusion de la barre de navigation

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

<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-4">Liste des visiteurs</h2>

    <!-- Formulaire de filtrage -->
    <form class="mb-6" method="POST" action="">
        <div class="flex flex-wrap -mx-3 mb-6">
            <!-- Filtrage par ville -->
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ville">
                    Choisir la ville
                </label>
                <div class="relative">
                    <select name="ville" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="toutes">Toutes villes</option>
                        <?php
                        // Récupère les villes uniques à partir des visiteurs
                        $villes = array_unique(array_map(function($user) {
                            return $user->Ville();
                        }, $visiteurs));

                        foreach ($villes as $v) {
                            $selected = ($ville === $v) ? 'selected' : '';
                            echo "<option value='".htmlspecialchars($v)."' $selected>".htmlspecialchars($v)."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Filtrage par nom -->
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="partieNom">
                    Saisir tout ou partie du nom
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="partieNom" value="<?= htmlspecialchars($partieNom, ENT_QUOTES) ?>" />
            </div>

            <!-- Choix du filtrage (Début, Fin, N'importe) -->
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Filtrer par
                </label>
                <div class="flex">
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" class="form-radio" name="debutFin" value="debut" <?= $debutFin === 'debut' ? 'checked' : '' ?>>
                        <span class="ml-2">Début</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" class="form-radio" name="debutFin" value="fin" <?= $debutFin === 'fin' ? 'checked' : '' ?>>
                        <span class="ml-2">Fin</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="debutFin" value="nimporte" <?= $debutFin === 'nimporte' ? 'checked' : '' ?>>
                        <span class="ml-2">Dans la chaîne</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Bouton de filtrage -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filtrer
            </button>
        </div>
    </form>

    <!-- Table des visiteurs -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Nom</th>
                <th class="py-3 px-4 text-left">Prénom</th>
                <th class="py-3 px-4 text-left">Login</th>
                <th class="py-3 px-4 text-left">Ville</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php foreach ($visiteursFiltres as $user): ?>
                <tr class="border-t border-gray-300">
                    <td class="py-3 px-4"><?php echo htmlspecialchars($user->Nom()); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($user->Prenom()); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($user->Login()); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($user->Ville()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bouton de déconnexion -->
    <div class="mt-6">
        <a href="seConnecter.php?logout=1" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Se déconnecter</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
