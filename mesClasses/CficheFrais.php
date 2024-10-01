<?php

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
        try {
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
        } catch (Exception $e) {
            error_log("Erreur lors de l'ajout des frais forfaitaires : " . $e->getMessage());
        }
    }

    public function ajouterFraisHorsForfait($libelle, $date, $montant) {
        try {
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
        } catch (Exception $e) {
            error_log("Erreur lors de l'ajout des frais hors forfait : " . $e->getMessage());
        }
    }

    public function getFraisHorsForfait() {
        try {
            $query = "SELECT * FROM lignefraishorsforfait WHERE idVisiteur = :idVisiteur AND mois = :mois";
            return $this->dao->getTabDataFromSql($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des frais hors forfait : " . $e->getMessage());
            return [];
        }
    }

    // Nouvelle méthode pour récupérer tous les frais forfaitaires pour l'utilisateur et le mois donnés
    public function getFraisForfait() {
        try {
            $query = "SELECT * FROM lignefraisforfait WHERE idVisiteur = :idVisiteur AND mois = :mois";
            return $this->dao->getTabDataFromSql($query, ['idVisiteur' => $this->idVisiteur, 'mois' => $this->mois]);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des frais forfaitaires : " . $e->getMessage());
            return [];
        }
    }

    // Méthode pour mettre à jour la fiche de frais
    private function mettreAJourFicheFrais() {
        try {
            $query = "INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) 
                      VALUES (:idVisiteur, :mois, 0, 0, NOW(), 'CR')
                      ON DUPLICATE KEY UPDATE dateModif = NOW()";
            
            $params = [
                'idVisiteur' => $this->idVisiteur,
                'mois' => $this->mois
            ];
            
            $this->dao->execute($query, $params);
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour de la fiche de frais : " . $e->getMessage());
        }
    }

    // Nouvelle méthode pour mettre à jour un frais forfaitaire spécifique
    public function mettreAJourFraisForfait($idFraisForfait, $quantite) {
        try {
            $this->dao->updateFraisForfait($idFraisForfait, $quantite);
            $this->mettreAJourFicheFrais();
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour des frais forfaitaires : " . $e->getMessage());
        }
    }
}

