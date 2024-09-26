<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-8">
            <a href="saisirFicheFrais.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'saisirFicheFrais.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Saisie Fiche de Frais
            </a>
            <a href="liste_visiteur.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'liste_visiteur.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Liste des Visiteurs
            </a>
        </div>
        
        <a href="seConnecter.php?logout=1" class="text-white hover:text-gray-400 text-base">
            Déconnexion
        </a>
    </div>
</nav>