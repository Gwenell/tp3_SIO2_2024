class CficheFrais {
    private $idVisiteur;
    private $mois;
    private $fraisForfait;
    private $fraisHorsForfait;

    public function __construct($idVisiteur, $mois) {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
    }

    public function verifFicheFrais() {
        // Vérifie si la fiche de frais existe déjà pour ce visiteur et ce mois
    }

    public function insertFicheFrais() {
        // Insère une nouvelle fiche de frais si elle n'existe pas
    }
}
