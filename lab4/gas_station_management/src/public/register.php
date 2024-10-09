<?php
require_once '../config/database.php';
require_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'employee';

    $userController = new UserController($pdo);
    $userId = $userController->register($username, $password, $role);

    if ($userId) {
        echo "User registered successfully!";
        header('Location: login.php');
    } else {
        echo "Failed to register user.";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="employee">Employee</option>
        <option value="manager">Manager</option>
    </select>
    <button type="submit">Register</button>
</form>