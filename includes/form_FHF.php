<section class="mb-8 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Frais Hors Forfait</h2>
    <form action="saisirFicheFrais.php" method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="libelle">Libellé du frais hors forfait</label>
            <input type="text" id="libelle" name="libelle" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
            <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="montant">Montant des frais hors forfait</label>
            <input type="number" id="montant" name="montant" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" name="submitFHF" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Enregistrer
        </button>
    </form>
</section>