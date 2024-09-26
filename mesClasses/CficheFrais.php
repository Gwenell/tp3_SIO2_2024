<?php
require_once 'Cdao.php';

class CficheFrais {
    private $idVisiteur;
    private $mois;
    private $dao;

    public function __construct($idVisiteur, $mois) {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
        $this->dao = new Cdao();
    }

    public function ajouterFraisForfait($idFraisForfait, $quantite) {
        $query = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
                  VALUES (:idVisiteur, :mois, :idFraisForfait, :quantite)
                  ON DUPLICATE KEY UPDATE quantite = :quantite";
        
        $params = [
            'idVisiteur' => $this->idVisiteur,
            'mois' => $this->mois,
            'idFraisForfait' => $idFraisForfait,
            'quantite' => $quantite
        ];
        
        $this->dao->execute($query, $params);
        $this->mettreAJourFicheFrais();
    }

    public function ajouterFraisHorsForfait($libelle, $date, $montant) {
        $query = "INSERT INTO lignefraishorsforfait (idVisiteur, mois, libelle, date, montant) 
                  VALUES (:idVisiteur, :mois, :libelle, :date, :montant)";
        
        $params = [
            'idVisiteur' => $this->idVisiteur,
            'mois' => $this->mois,
            'libelle' => $libelle,
            'date' => $date,
            'montant' => $montant
        ];
        
        $this->dao->execute($query, $params);
        $this->mettreAJourFicheFrais();
    }

    public function getFraisHorsForfait() {
        $query = "SELECT * FROM lignefraishorsforfait WHERE idVisiteur = :idVisiteur AND mois = :mois";
        return $this->dao->getTabDataFromSql($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
    }

    private function mettreAJourFicheFrais() {
        $query = "INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) 
                  VALUES (:idVisiteur, :mois, 0, 0, NOW(), 'CR')
                  ON DUPLICATE KEY UPDATE dateModif = NOW()";
        
        $params = [
            'idVisiteur' => $this->idVisiteur,
            'mois' => $this->mois
        ];
        
        $this->dao->execute($query, $params);
    }
}