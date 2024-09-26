<?php
session_start();

$errors = [];
$jobTitle = $cName = $yoe = $response = "";

// if(isset($_SESSION['email'])){
//     $email = $_SESSION['email'];
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Experience</title>
</head>
<body>
    <h1>Work Experience</h1>
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
        <textarea name="respons" id="respons" placeholder="Enter your Responsibility"><?php echo htmlspecialchars($response); ?>"</textarea>
        <span class="error"><?php echo isset($errors['respons']) ? $errors['respons'] : ''; ?></span><br>

        <input type="submit"  value="Next Step">
    </form>
</body>
</html>