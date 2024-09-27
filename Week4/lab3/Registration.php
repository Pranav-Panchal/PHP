<?php

$file = 'user.json';
$users = [];
$errors = [];

if (file_exists($file) && filesize($file) > 0) {
    $jsonData = file_get_contents($file);
    $users = json_decode($jsonData, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];

        $users[] = $newUser;

        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

        header('location: login.php');
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lab 4</title>
</head>
<body>
    <h1>Registration Form</h1>
    <div class="form">
        <form action="" method="post">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" placeholder="Enter your username">
            <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" placeholder="Enter your email">
            <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span><br>

            <input type="submit" name="register" value="Register">       
        </form>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>
</body>
</html>
