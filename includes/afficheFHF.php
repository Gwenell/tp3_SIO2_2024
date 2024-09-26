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