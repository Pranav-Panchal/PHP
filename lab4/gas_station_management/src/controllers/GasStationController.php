<?php
require_once '../repositories/FuelRepository.php';
require_once '../repositories/TransactionRepository.php';

class GasStationController {
    private $fuelRepository;
    private $transactionRepository;

    public function __construct($pdo) {
        $this->fuelRepository = new FuelRepository($pdo);
        $this->transactionRepository = new TransactionRepository($pdo);
    }

    public function addFuelType($name, $price_per_liter) {
        return $this->fuelRepository->create(['name' => $name, 'price_per_liter' => $price_per_liter]);
    }

    public function updateFuelType($id, $name, $price_per_liter) {
        return $this->fuelRepository->update($id, ['name' => $name, 'price_per_liter' => $price_per_liter]);
    }

    public function deleteFuelType($id) {
        return $this->fuelRepository->deleteById($id);
    }

    public function getFuelInventory() {
        return $this->fuelRepository->findAll();
    }

    public function recordTransaction($fuel_type, $liters_sold) {
        return $this->transactionRepository->create(['fuel_type' => $fuel_type, 'liters_sold' => $liters_sold]);
    }

    public function getAllTransactions() {
        return $this->transactionRepository->getTransactionsWithFuelDetails();
    }
}