<?php
session_start();

$errors = [];
$jobTitle = $cName = $yoe = $response = "";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

if(isset($_SESSION['job_title'])){
    $jobTitle = $_SESSION['job_title'];
}
if(isset($_SESSION['c_name'])){
    $cName = $_SESSION['c_name'];
}
if(isset($_SESSION['experience'])){
    $yoe = $_SESSION['experience'];
}
if(isset($_SESSION['respons'])){
    $response = $_SESSION['respons'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['previous'])){
        header('Location: background.php');
        exit();
    }

    //implimenting sanitization and validation to each field

    $jobTitle = filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING);
    if (empty($jobTitle)) {
        $errors['job_title'] = "job title is required.";
    }

    $cName = filter_input(INPUT_POST, 'c_name', FILTER_SANITIZE_STRING);
    if (empty($cName)) {
        $errors['c_name'] = "Company Name is required.";
    }

    $yoe = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING);
    if (empty($yoe)) {
        $errors['experience'] = "Year of experience is required.";
    } 

    $response = filter_input(INPUT_POST, 'respons', FILTER_SANITIZE_STRING);
    if (empty($response)) {
        $errors['respons'] = "Responsibility is required.";
    } 

    //i am storing data in session once its done

    if (empty($errors)) {

        $_SESSION['job_title'] = $jobTitle;
        $_SESSION['c_name'] = $cName;
        $_SESSION['experience'] = $yoe;
        $_SESSION['respons'] = $response;

        header('Location: review.php');
        exit();
    }



}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();

    if(isset($_COOKIE['username_remember'])){
        setcookie('username_remember', '', time() - 3600, "/");
    }

    
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Work Experience</title>
</head>
<body>
    <h3>Hey <?php echo htmlspecialchars($username); ?></h3>
    <h1>Work Experience</h1>
    <div class="form">
        <form action="" method="POST">
        <label for="job_title">Previous Job Title</label>
            <input type="text" name="job_title" id="job_title" value="<?php echo htmlspecialchars($jobTitle); ?>" placeholder="Enter your job_title">
            <span class="error"><?php echo isset($errors['job_title']) ? $errors['job_title'] : ''; ?></span><br>

            <label for="c_name">Company Name</label>
            <input type="text" name="c_name" id="c_name" value="<?php echo htmlspecialchars($cName); ?>" placeholder="Enter your company name">
            <span class="error"><?php echo isset($errors['c_name']) ? $errors['c_name'] : ''; ?></span><br>

            <label for="experience">Years of Experience</label>
            <input type="number" name="experience" id="experience" value="<?php echo htmlspecialchars($yoe); ?>" placeholder="Enter your years of experience ">
            <span class="error"><?php echo isset($errors['experience']) ? $errors['experience'] : ''; ?></span><br>

            <label for="respons">Key Responsibilities</label>
            <textarea name="respons" id="respons" placeholder="Enter your Responsibility"><?php echo htmlspecialchars($response); ?></textarea>
            <span class="error"><?php echo isset($errors['respons']) ? $errors['respons'] : ''; ?></span><br>

            <div>
                <input type="submit"  name="previous" value="Previous">
                <input type="submit"  name="next" value="Next Step">
            </div>

        </form>
    </div>

    <form action="" method="POST">
        <button class="logout" type="submit" name="logout">LOGOUT</button>
    </form>


</body>
</html>