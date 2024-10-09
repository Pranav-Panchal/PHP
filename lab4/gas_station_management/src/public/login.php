<?php
session_start();
require_once '../config/database.php';
require_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userController = new UserController($pdo);
    $user = $userController->login($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
    } else {
        echo "Invalid credentials!";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>