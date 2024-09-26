<?php
session_start();

$errors = [];
$degreeName = $fieldStudy = $instituteName = $yog = "";

// if(isset($_SESSION['email'])){
//     $email = $_SESSION['email'];
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational background</title>
</head>
<body>
    <h1>Educational background</h1>
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

        <input type="submit"  value="Next Step">
    </form>
</body>
</html>