<?php
require_once 'BaseRepository.php';

class TransactionRepository extends BaseRepository {

    public function __construct($pdo) {
        parent::__construct($pdo, 'transactions');
    }

    public function create($data) {
        $sql = "INSERT INTO transactions (fuel_type, liters_sold) VALUES (:fuel_type, :liters_sold)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['fuel_type' => $data['fuel_type'], 'liters_sold' => $data['liters_sold']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE transactions SET fuel_type = :fuel_type, liters_sold = :liters_sold WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['fuel_type' => $data['fuel_type'], 'liters_sold' => $data['liters_sold'], 'id' => $id]);
    }

    public function getTransactionsWithFuelDetails() {
        $sql = "SELECT t.id, f.name as fuel_name, t.liters_sold, t.transaction_date 
                FROM transactions t 
                JOIN fuels f ON t.fuel_type = f.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}