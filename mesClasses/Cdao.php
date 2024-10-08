<?php
class Cdao {
    private $conn;

    // Constructeur qui établit la connexion à la base de données
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=gsb", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer le montant d'un frais forfaitaire spécifique
    public function getMontantFraisForfait($idFraisForfait) {
        $query = "SELECT montant FROM fraisforfait WHERE id = :idFraisForfait";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['idFraisForfait' => $idFraisForfait]);
        return $stmt->fetchColumn();
    }

    // Méthode pour récupérer tous les frais forfaitaires triés par date
    public function getTousFraisForfaitSortedByDate() {
        $query = "SELECT f.libelle, f.montant, l.quantite, l.mois 
                  FROM lignefraisforfait l 
                  JOIN fraisforfait f ON l.idFraisForfait = f.id 
                  ORDER BY l.mois DESC";
        return $this->getTabDataFromSql($query);
    }

    // Méthode pour exécuter une requête SELECT et obtenir un tableau de résultats
    public function getTabDataFromSql($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour exécuter une requête (INSERT, UPDATE, DELETE)
    public function execute($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    // Méthode pour mettre à jour un frais forfaitaire
    public function updateFraisForfait($idFraisForfait, $quantite, $idVisiteur, $mois) {
        $query = "UPDATE lignefraisforfait SET quantite = :quantite 
                  WHERE idFraisForfait = :idFraisForfait AND idVisiteur = :idVisiteur AND mois = :mois";
        $params = [
            'quantite' => $quantite,
            'idFraisForfait' => $idFraisForfait,
            'idVisiteur' => $idVisiteur,
            'mois' => $mois
        ];
        return $this->execute($query, $params);
    }

    // Méthode pour vérifier si un frais forfaitaire existe dans la base
    public function verifierFraisForfait($idFrais) {
        $query = "SELECT COUNT(*) FROM fraisforfait WHERE id = :idFrais";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idFrais', $idFrais);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
