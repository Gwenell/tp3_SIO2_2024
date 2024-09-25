<form action="submitFicheFrais.php" method="POST" class="bg-white shadow-md rounded p-6">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="idFraisForfait">Type de frais forfaitaires</label>
        <select id="idFraisForfait" name="idFraisForfait" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            <option value="ETP">Forfait Etape</option>
            <option value="KM">Frais Kilométrique</option>
            <option value="NUI">Nuitée Hôtel</option>
            <option value="REP">Repas Restaurant</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="montantFF">Quantité</label>
        <input type="number" id="montantFF" name="montantFF" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Enregistrer
    </button>
</form>
