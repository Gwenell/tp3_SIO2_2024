<?php
require_once 'mesClasses/Ctrl.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: seConnecter.php");
    exit();
}

$ctrl = new Ctrl();
$visiteursTries = $ctrl->getVisiteursTrie();

$pageTitle = "Liste des visiteurs";
include 'includes/head.php';
?>

<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-4">Liste des visiteurs</h2>
    
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Prénom</th>
                <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Login</th>
                <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Ville</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php foreach ($visiteursTries as $user): ?>
                <tr>
                    <td class="w-1/4 text-left py-3 px-4"><?php echo htmlspecialchars($user->Nom()); ?></td>
                    <td class="w-1/4 text-left py-3 px-4"><?php echo htmlspecialchars($user->Prenom()); ?></td>
                    <td class="w-1/4 text-left py-3 px-4"><?php echo htmlspecialchars($user->Login()); ?></td>
                    <td class="w-1/4 text-left py-3 px-4"><?php echo htmlspecialchars($user->Ville()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-6">
        <a href="seConnecter.php?logout=1" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Se déconnecter</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>