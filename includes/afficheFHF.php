<table class="min-w-full bg-white">
    <thead>
        <tr class="bg-gray-800 text-white">
            <th class="text-left py-3 px-4">Date</th>
            <th class="text-left py-3 px-4">Libellé</th>
            <th class="text-left py-3 px-4">Montant</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($fraisHorsForfait)) : ?>
            <?php foreach ($fraisHorsForfait as $frais): ?>
                <tr>
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
