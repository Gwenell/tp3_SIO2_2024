<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-8">
            <a href="liste_visiteur.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'liste_visiteur.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Liste des Visiteurs
            </a>
            <a href="saisirFicheFrais.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'saisirFicheFrais.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Saisie Fiche de Frais
            </a>
        </div>
        
        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['prenom'])): ?>
                <span class="text-white" style="color: #00bfff;"><?php echo htmlspecialchars($_SESSION['prenom']); ?></span>
            <?php endif; ?>
            <a href="seConnecter.php?logout=1" class="text-white hover:text-gray-400 text-base">
                Déconnexion
            </a>
        </div>
    </div>
</nav>
