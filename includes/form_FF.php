<section class="mb-8 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Frais Forfaitaires</h2>
    <form action="saisirFicheFrais.php" method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idFraisForfait">Type de frais forfaitaires</label>
            <select id="idFraisForfait" name="idFraisForfait" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="ETP">Forfait Etape</option>
                <option value="KM">Frais Kilométrique</option>
                <option value="NUI">Nuitée Hôtel</option>
                <option value="REP">Repas Restaurant</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantite">Quantité</label>
            <input type="number" id="quantite" name="quantite" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" name="submitFF" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Enregistrer
        </button>
    </form>
</section>