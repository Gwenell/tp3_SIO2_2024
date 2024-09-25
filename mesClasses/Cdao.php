<?php
/**
 * Classe d'accès aux données (DAO - Data Access Object)
 */
class Cdao {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=gsb", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**
     * Exécute une requête SQL SELECT et retourne les résultats
     */
    public function getTabDataFromSql($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Exécute une requête SQL (INSERT, UPDATE, DELETE)
     */
    public function execute($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }
}
