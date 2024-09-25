<?php
class CficheFrais {
    private $idVisiteur;
    private $mois;

    public function __construct($idVisiteur, $mois) {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
    }

    // Vérifier si la fiche de frais existe
    public function verifFicheFrais($dao) {
        $query = "SELECT * FROM fichefrais WHERE idVisiteur = :idVisiteur AND mois = :mois";
        return $dao->getTabDataFromSql($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
    }

    // Créer une nouvelle fiche de frais si elle n'existe pas
    public function insertFicheFrais($dao) {
        if (!$this->verifFicheFrais($dao)) {
            $query = "INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) 
                      VALUES (:idVisiteur, :mois, 0, 0, CURRENT_DATE, 'CR')";
            $dao->execute($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
        }
    }

    // Ajouter des frais forfaitaires
    public function ajouterFraisForfait($dao, $idFraisForfait, $quantite) {
        $query = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite)
                  VALUES (:idVisiteur, :mois, :idFraisForfait, :quantite)
                  ON DUPLICATE KEY UPDATE quantite = quantite + :quantite";
        $dao->execute($query, [
            'idVisiteur' => $this->idVisiteur,
            'mois' => $this->mois,
            'idFraisForfait' => $idFraisForfait,
            'quantite' => $quantite
        ]);
    }

    // Ajouter des frais hors forfait
    public function ajouterFraisHorsForfait($dao, $libelle, $montant) {
        $query = "INSERT INTO lignefraishorsforfait (idVisiteur, mois, libelle, date, montant)
                  VALUES (:idVisiteur, :mois, :libelle, CURRENT_DATE, :montant)";
        $dao->execute($query, [
            'idVisiteur' => $this->idVisiteur,
            'mois' => $this->mois,
            'libelle' => $libelle,
            'montant' => $montant
        ]);
    }

    // Obtenir les frais hors forfait
    public function getFraisHorsForfait($dao) {
        $query = "SELECT * FROM lignefraishorsforfait WHERE idVisiteur = :idVisiteur AND mois = :mois";
        return $dao->getTabDataFromSql($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
    }
}
