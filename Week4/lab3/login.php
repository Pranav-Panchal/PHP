<?php
session_start();

$file = 'user.json';
$users = [];
$errors = [];

if (file_exists($file) && filesize($file) > 0) {
    $jsonData = file_get_contents($file);
    $users = json_decode($jsonData, true);
}

//adding cookie
if(isset($_COOKIE['username_remember'])){
    $usernameRemember = $_COOKIE['username_remember'];
}else{
    $usernameRemember = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']);

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (empty($errors)) {
        $isUser = false;

        foreach($users as $user){
            if($user['username'] === $username){
                $isUser = true;

                if(password_verify($password, $user['password'])){

                    session_regenerate_id(true);

                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $user['email'];
                    
                    if($rememberMe){
                        //setting up cookie for 7 days 
                        setcookie('username_remember', $username, time() + (7 * 24 * 60 * 60), "/");
                    }else{
                        if(isset($_COOKIE['username_remember'])){
                            setcookie('username_remember', '', time() - 3600, "/");
                        }
                    }

                    header('Location: index.php');
                    exit();
                }else{
                    $errors['password'] = "Incorrect Password";
                }
                break;
            }
        }
        if(!$isUser){
            $errors['username'] = "username not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo isset($username) ? htmlspecialchars($username) : htmlspecialchars($usernameRemember); ?>" placeholder="Enter your username">
        <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span><br>

        <label for="remember_me">
            <input type="checkbox" name="remember_me" id="remember_me"<?php if(!empty($usernameRemember)) echo 'checked'; ?>>
            Remember Me
        </label><br>

        <input type="submit" name="login" value="Login">       
    </form>

    <p>Don't have an account? <a href="registration.php">Register Here</a></p>
</body>
</html>