<section class="mb-8 p-6 bg-gray-900 shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-purple-500 mb-4">Frais Hors Forfait</h2>
    <form action="saisirFicheFrais.php" method="POST">
        <div class="mb-4">
            <label class="block text-purple-500 text-sm font-bold mb-2" for="libelle">Libellé du frais hors forfait</label>
            <input type="text" id="libelle" name="libelle" class="w-full p-2 border border-gray-600 bg-gray-900 text-white rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-purple-500 text-sm font-bold mb-2" for="montant">Montant</label>
            <input type="number" id="montant" name="montant" class="w-full p-2 border border-gray-600 bg-gray-900 text-white rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-purple-500 text-sm font-bold mb-2" for="date">Date</label>
            <input type="date" id="date" name="date" class="w-full p-2 border border-gray-600 bg-gray-900 text-white rounded" required>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Ajouter le frais</button>
        </div>
    </form>
</section>
