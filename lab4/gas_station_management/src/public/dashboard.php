<?php
require_once '../middleware/AuthMiddleware.php';
require_once '../config/database.php';
require_once '../controllers/GasStationController.php';

$controller = new GasStationController($pdo);

// Get Fuel Inventory
$fuelInventory = $controller->getFuelInventory();

// Get Transactions
$transactions = $controller->getAllTransactions();
?>

<h1>Fuel Inventory</h1>
<table>
    <tr>
        <th>Fuel Name</th>
        <th>Price Per Liter</th>
    </tr>
    <?php foreach ($fuelInventory as $fuel) : ?>
    <tr>
        <td><?= $fuel['name']; ?></td>
        <td><?= $fuel['price_per_liter']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h1>Transaction List</h1>
<table>
    <tr>
        <th>Fuel Name</th>
        <th>Liters Sold</th>
        <th>Date</th>
    </tr>
    <?php foreach ($transactions as $transaction) : ?>
    <tr>
        <td><?= $transaction['fuel_name']; ?></td>
        <td><?= $transaction['liters_sold']; ?></td>
        <td><?= $transaction['transaction_date']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>