<form action="submitFraisHorsForfait.php" method="POST" class="bg-white shadow-md rounded p-6">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="libelleFHF">Libellé du frais hors forfait</label>
        <input type="text" id="libelleFHF" name="libelleFHF" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="montantFHF">Montant des frais hors forfait</label>
        <input type="number" id="montantFHF" name="montantFHF" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Enregistrer
    </button>
</form>
