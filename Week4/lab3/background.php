<?php
session_start();

$errors = [];
$degreeName = $fieldStudy = $instituteName = $yog = "";

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

if(isset($_SESSION['degree'])){
    $degreeName = $_SESSION['degree'];
}
if(isset($_SESSION['field'])){
    $fieldStudy = $_SESSION['field'];
}
if(isset($_SESSION['institute'])){
    $instituteName = $_SESSION['institute'];
}
if(isset($_SESSION['year'])){
    $yog = $_SESSION['year'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['previous'])){
        header('Location: index.php');
        exit();
    }

    //implimenting sanitization and validation to each field

    $degreeName = filter_input(INPUT_POST, 'degree', FILTER_SANITIZE_STRING);
    if (empty($degreeName)) {
        $errors['degree'] = "degree is required.";
    }

    $fieldStudy = filter_input(INPUT_POST, 'field', FILTER_SANITIZE_STRING);
    if (empty($fieldStudy)) {
        $errors['field'] = "Field of study is required.";
    }

    $instituteName = filter_input(INPUT_POST, 'institute', FILTER_SANITIZE_STRING);
    if (empty($instituteName)) {
        $errors['institute'] = "Institute name is required.";
    } 

    $yog = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
    if (empty($yog)) {
        $errors['year'] = "Year is required.";
    } 

    //i am storing data in session once its done

    if (empty($errors)) {

        $_SESSION['degree'] = $degreeName;
        $_SESSION['field'] = $fieldStudy;
        $_SESSION['institute'] = $instituteName;
        $_SESSION['year'] = $yog;

        header('Location: work_experience.php');
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
    <title>Educational background</title>
</head>
<body>
<body>
    <h3>Hey, <?php echo htmlspecialchars($username); ?>! </h3>
    <h1>Educational background</h1>
    <div class="form">
        <form action="" method="POST">
        <label for="degree">Highest Degree Obtained</label>
            <input type="text" name="degree" id="degree" value="<?php echo htmlspecialchars($degreeName); ?>" placeholder="Enter your degree name">
            <span class="error"><?php echo isset($errors['degree']) ? $errors['degree'] : ''; ?></span><br>

            <label for="field">Field of Study</label>
            <input type="text" name="field" id="field" value="<?php echo htmlspecialchars($fieldStudy); ?>" placeholder="Enter your field of study">
            <span class="error"><?php echo isset($errors['field']) ? $errors['field'] : ''; ?></span><br>

            <label for="institute">Name of Institution</label>
            <input type="text" name="institute" id="institute" value="<?php echo htmlspecialchars($instituteName); ?>" placeholder="Enter your institute name">
            <span class="error"><?php echo isset($errors['institute']) ? $errors['institute'] : ''; ?></span><br>

            <label for="year">Year of Graduation</label>
            <input type="text" name="year" id="year" value="<?php echo htmlspecialchars($yog); ?>" placeholder="Enter your graduation year">
            <span class="error"><?php echo isset($errors['year']) ? $errors['year'] : ''; ?></span><br>

            <div>
                <button type="submit" name="previous">Previous</button>
                <button type="submit" name="next">Next Step</button>
            </div>
        </form>
    </div>

    <form action="" method="POST">
        <button class="logout"  type="submit" name="logout">LOGOUT</button>
    </form>
    
</body>
</html>