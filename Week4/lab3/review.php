<?php
 
session_start();

if(!isset($_SESSION['full-name']) || !isset( $_SESSION['email']) || !isset($_SESSION['phone-number']) || 
!isset($_SESSION['degree']) || !isset($_SESSION['field']) || !isset($_SESSION['institute']) || !isset($_SESSION['year']) || 
!isset($_SESSION['job_title']) || !isset($_SESSION['c_name']) || !isset($_SESSION['experience']) || !isset($_SESSION['respons'])){

    header('Location: index.php');
    exit();
}

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

$fullName = $_SESSION['full-name'];
$email = $_SESSION['email'];
$phoneNumber = $_SESSION['phone-number'];

$degreeName = $_SESSION['degree'];
$fieldStudy = $_SESSION['field'];
$instituteName = $_SESSION['institute'];
$yog = $_SESSION['year'];

$jobTitle = $_SESSION['job_title'];
$cName = $_SESSION['c_name'];
$yoe = $_SESSION['experience'];
$response = $_SESSION['respons'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){

    $application = [
        'full_name'=> $fullName,
        'email' => $email,
        'phone_number' => $phoneNumber,
        'degree' => $degreeName,
        'field' => $fieldStudy,
        'institute' => $instituteName,
        'graduation_year' => $yog,
        'job' => $jobTitle,
        'company_name' => $cName,
        'experience' => $yoe,
        'responsible' => $response
    ];

    $file = 'applications.json';

    $applications = [];
    if(file_exists($file)){
        $applications = json_decode(file_get_contents($file), true);
    }

    $applications[] = $application;

    file_put_contents($file, json_encode($applications, JSON_PRETTY_PRINT));

    $to = $_SESSION['email'];
    $subject = "Application Submitted!!";
    $message = "Dear {$_SESSION['full-name']}, \n\n Your application has been submitted. ";

    echo "<h2>Application Submitted!</h2>";
    echo "<h2>The confirmation mail has been sent to your email.</h2>";

    session_unset();
    session_destroy();

    if(isset($_COOKIE['username_remember'])){
        setcookie('username_remember', '', time() - 3600, "/");
    }

    echo'<a href="login.php"><button>Logout</button></a>';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Review</title>
</head>
<body>
    <h3>Hey <?php echo htmlspecialchars($username); ?>! </h3>
    <h1>Review your Application</h1>
    <div class="form">
    <p> Full Name: <?php echo htmlspecialchars ($fullName); ?><a href="index.php">Edit</a></p> 
    <p> Email: <?php echo htmlspecialchars ($email); ?><a href="index.php">Edit</a> </p> 
    <p> Phone Number: <?php echo htmlspecialchars ($phoneNumber); ?><a href="index.php">Edit</a> </p> 

    <p> Highest Degree Obtained:<?php echo htmlspecialchars ($degreeName); ?><a href="background.php">Edit</a> </p>  
    <p> Field of Study: <?php echo htmlspecialchars ($fieldStudy); ?><a href="background.php">Edit</a> </p> 
    <p> Institution Name: <?php echo htmlspecialchars ($instituteName); ?><a href="background.php">Edit</a> </p> 
    <p> Year of Graduation: <?php echo htmlspecialchars ($yog); ?><a href="background.php">Edit</a> </p>  

    <p> Job Title: <?php echo htmlspecialchars ($jobTitle); ?><a href="work_experience.php">Edit</a> </p> 
    <p> Company Name: <?php echo htmlspecialchars ($cName); ?><a href="work_experience.php">Edit</a> </p>  
    <p> Year of Experience: <?php echo htmlspecialchars ($yoe); ?><a href="work_experience.php">Edit</a> </p>  
    <p> Responsibilities: <?php echo htmlspecialchars ($response); ?><a href="work_experience.php">Edit</a> </p> 

    <form action="" method="POST">
        <button type="submit" name="submit"> Submit </button>
        <a href="index.php"><button type="button">Previous</button></a>
    </form>
    </div>
</body>
</html>