<?php
session_start();

$errors = [];
$fullName = $email = $phoneNumber = "";

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //implimenting sanitization and validation to each field

    $fullName = filter_input(INPUT_POST, 'full-name', FILTER_SANITIZE_STRING);
    if (empty($fullName)) {
        $errors['full-name'] = "Name is required.";
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    $phoneNumber = filter_input(INPUT_POST, 'phone-number', FILTER_SANITIZE_STRING);
    if (empty($phoneNumber)) {
        $errors['phone-number'] = "Phone Number is required.";
    } 

    //i am storing data in session once its done

    if (empty($errors)) {

        $_SESSION['full-name'] = $fullName;
        $_SESSION['email'] = $email;
        $_SESSION['phone-number'] = $phoneNumber;

        header('location: background.php');
        exit();
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Info</title>
</head>
<body>
    <h1>Personal Details</h1>
    <form action="" method="POST">
    <label for="full-name">Full Name</label>
        <input type="text" name="full-name" id="full-name" value="<?php echo htmlspecialchars($fullName); ?>" placeholder="Enter your full name">
        <span class="error"><?php echo isset($errors['full-name']) ? $errors['full-name'] : ''; ?></span><br>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your email">
        <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span><br>

        <label for="phone-number">Phone Number</label>
        <input type="text" name="phone-number" id="phone-number" value="<?php echo htmlspecialchars($phoneNumber); ?>" placeholder="Enter your phone number">
        <span class="error"><?php echo isset($errors['phone-number']) ? $errors['phone-number'] : ''; ?></span><br>

        <input type="submit"  value="Next-step">
    </form>
</body>
</html>