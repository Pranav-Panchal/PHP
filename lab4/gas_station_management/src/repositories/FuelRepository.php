<?php
require_once 'BaseRepository.php';

class FuelRepository extends BaseRepository {

    public function __construct($pdo) {
        parent::__construct($pdo, 'fuels');
    }

    public function create($data) {
        $sql = "INSERT INTO fuels (name, price_per_liter) VALUES (:name, :price_per_liter)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $data['name'], 'price_per_liter' => $data['price_per_liter']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE fuels SET name = :name, price_per_liter = :price_per_liter WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['name' => $data['name'], 'price_per_liter' => $data['price_per_liter'], 'id' => $id]);
    }
}