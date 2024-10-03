<section class="mb-8 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Frais Forfaitaires</h2>
    
    <!-- Formulaire pour entrer les frais forfaitaires -->
    <form action="saisirFicheFrais.php" method="POST">
        <!-- Sélection du type de frais forfaitaires -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idFraisForfait">Type de frais forfaitaires</label>
            <select id="idFraisForfait" name="idFraisForfait" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="ETP" data-montant="110">Forfait Etape</option>
                <option value="KM" data-montant="0.62">Frais Kilométrique</option>
                <option value="NUI" data-montant="80">Nuitée Hôtel</option>
                <option value="REP" data-montant="25">Repas Restaurant</option>
            </select>
        </div>

        <!-- Entrée de la quantité -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantite">Quantité</label>
            <input type="number" id="quantite" name="quantite" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Conteneur pour les boutons -->
        <div class="flex space-x-4">
            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" name="submitFF" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer
            </button>

            <!-- Bouton pour afficher/masquer le tableau -->
            <button type="button" id="toggleTable" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Afficher/masquer Frais Forfaitaires
            </button>
        </div>
    </form>

    <!-- Section pour afficher les frais forfaitaires enregistrés -->
    <div id="fraisForfaitairesList" class="mt-6 hidden bg-gray-100 p-4 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Frais Forfaitaires Enregistrés</h3>

        <?php
        // Exemple d'accès à la base de données pour récupérer les frais forfaitaires
        $dao = new Cdao();
        $idVisiteur = $_SESSION['id']; // Remplacer par l'ID du visiteur connecté
        $mois = date('Ym'); // Remplacer par le mois en cours
        $query = "SELECT f.libelle, f.montant, l.quantite
                  FROM lignefraisforfait l
                  JOIN fraisforfait f ON l.idFraisForfait = f.id
                  WHERE l.idVisiteur = :idVisiteur AND l.mois = :mois";

        $params = ['idVisiteur' => $idVisiteur, 'mois' => $mois];
        $fraisForfaitaires = $dao->getTabDataFromSql($query, $params);

        if (empty($fraisForfaitaires)) {
            echo "<p>Aucun frais forfaitaire trouvé pour ce mois.</p>";
        } else {
            echo "<table class='min-w-full leading-normal text-center'>
                    <thead>
                        <tr>
                            <th class='text-center'>Type de Frais</th>
                            <th class='text-center'>Montant Unitaire</th>
                            <th class='text-center'>Quantité</th>
                            <th class='text-center'>Total</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($fraisForfaitaires as $frais) {
                $total = $frais['montant'] * $frais['quantite'];
                echo "<tr>
                        <td>{$frais['libelle']}</td>
                        <td>" . number_format($frais['montant'], 2) . " €</td>
                        <td>{$frais['quantite']}</td>
                        <td>" . number_format($total, 2) . " €</td>
                      </tr>";
            }

            echo "</tbody></table>";
        }
        ?>
    </div>
</section>

<!-- Script JavaScript pour gérer l'affichage du tableau et le calcul du montant -->
<script>
    // Fonction pour mettre à jour le montant total en fonction de la quantité et du type de frais sélectionné
    function updateMontantTotal() {
        const fraisForfaitSelect = document.getElementById('idFraisForfait');
        const quantiteInput = document.getElementById('quantite');

        // Obtenir le montant associé au frais forfaitaire sélectionné
        const montantFrais = parseFloat(fraisForfaitSelect.options[fraisForfaitSelect.selectedIndex].dataset.montant);
        const quantite = parseInt(quantiteInput.value);

        // Calculer le montant total
        const montantTotal = (montantFrais * quantite).toFixed(2);
    }

    // Écouteurs d'événements pour mettre à jour le montant lorsque le type de frais ou la quantité change
    document.getElementById('idFraisForfait').addEventListener('change', updateMontantTotal);
    document.getElementById('quantite').addEventListener('input', updateMontantTotal);

    // Gestion de l'affichage du tableau avec le bouton "Afficher/masquer Frais Forfaitaires"
    document.getElementById('toggleTable').addEventListener('click', function() {
        const tableDiv = document.getElementById('fraisForfaitairesList');
        if (tableDiv.classList.contains('hidden')) {
            tableDiv.classList.remove('hidden');
        } else {
            tableDiv.classList.add('hidden');
        }
    });
</script>

<style>
    table, th, td {
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: center;
    }
    /* Flexbox pour aligner les boutons */
    .flex {
        display: flex;
        align-items: center;
    }
    .space-x-4 > *:not(:last-child) {
        margin-right: 1rem;
    }
</style>
