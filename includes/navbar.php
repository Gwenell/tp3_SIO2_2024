<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-8"> <!-- Ajustement de l'espacement pour une dimension égale -->
            <!-- Bouton pour "Saisie Fiche de Frais" -->
            <a href="saisirFicheFrais.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'saisirFicheFrais.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Saisie Fiche de Frais
            </a>

            <!-- Bouton pour "Liste des Visiteurs" -->
            <a href="liste_visiteur.php" 
               class="<?php echo basename($_SERVER['PHP_SELF']) === 'liste_visiteur.php' ? 'text-gray-400 cursor-not-allowed' : 'text-white hover:text-gray-400'; ?> text-base">
                Liste des Visiteurs
            </a>
        </div>
        
        <!-- Bouton pour la déconnexion à droite -->
        <a href="seConnecter.php?logout=1" class="text-white hover:text-gray-400 text-base">
            Déconnexion
        </a>
    </div>
</nav>
