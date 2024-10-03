<section class="p-6 bg-gray-900 shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-purple-500 mb-4">Liste des Frais Hors Forfait</h2>
    <table class="min-w-full bg-gray-900 text-white border border-gray-600">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left text-purple-500">Date</th>
                <th class="py-3 px-4 text-left text-purple-500">Libellé</th>
                <th class="py-3 px-4 text-right text-purple-500">Montant</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($fraisHorsForfait as $frais) {
            echo '<tr class="border-b border-gray-600">';
            echo '<td class="py-2 px-4 bg-gray-800 text-left">' . htmlspecialchars($frais['date']) . '</td>';
            echo '<td class="py-2 px-4 bg-gray-800 text-left">' . htmlspecialchars($frais['libelle']) . '</td>';
            echo '<td class="py-2 px-4 bg-gray-800 text-right">' . htmlspecialchars($frais['montant']) . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</section>
