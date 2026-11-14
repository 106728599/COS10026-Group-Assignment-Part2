<?php
    // Check POST request
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: apply.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="description" content="Creating a website for a Travel & Tourism Technology Company">
    <meta name="keywords" content="reference number, job title, salary, responsibilities, requirements">
    <meta name="author" content="Soo Kian Meng, Pang Hui Xin, Jarome Loo, Lee Xiao Yan">
    <title>Web Technology Project Group Assignment</title>
</head>

<body>
<?php
    // connect to database
    $conn = mysqli_connect("localhost", "root", "", "travexa_db");

    // check for database connection
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Create EOI table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS eoi (
    EOINumber INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jobRefNum VARCHAR(5) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    dateOfBirth VARCHAR(10) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    streetAddress VARCHAR(40) NOT NULL,
    suburbTown VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode VARCHAR(5) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(12) NOT NULL,
    skills VARCHAR(100) DEFAULT NULL,
    otherSkills TEXT NULL,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";
if (! mysqli_query($conn,$sql)) {
    die("Table creation failed: " . mysqli_error($conn));
}

     // Retrieve and sanitise form data
$jobRefNum = trim(stripslashes($_POST['jobRefNum'] ?? ''));
$firstName = trim(stripslashes($_POST['firstName'] ?? ''));
$lastName = trim(stripslashes($_POST['lastName'] ?? ''));
$dateOfBirth = trim(stripslashes($_POST['dateOfBirth'] ?? ''));
$gender = trim(stripslashes($_POST['gender'] ?? ''));
$streetAddress = trim(stripslashes($_POST['streetAddress'] ?? ''));
$suburbTown = trim(stripslashes($_POST['suburbTown'] ?? ''));
$state = trim(stripslashes($_POST['state'] ?? ''));
$postcode = trim(stripslashes($_POST['postcode'] ?? ''));
$email = trim(stripslashes($_POST['email'] ?? ''));
$phoneNumber = trim(stripslashes($_POST['phoneNumber'] ?? ''));

// Validate selected skills
$allowedSkills = ['html', 'css', 'javaScript', 'php', 'mysql'];

$selectedSkills = $_POST['skills'] ?? [];

if (!is_array($selectedSkills)) {
    die("Invalid skills selection.");
}

foreach ($selectedSkills as $skill) {
    if (!in_array($skill, $allowedSkills, true)) {
        die("Invalid skills selection.");
    }
}

$skills = implode(", ", $selectedSkills);

$otherSkills = trim(stripslashes($_POST['otherSkills'] ?? ''));


    // Check required fields
if (
    empty($jobRefNum) ||
    empty($firstName) ||
    empty($lastName) ||
    empty($dateOfBirth) ||
    empty($gender) ||
    empty($streetAddress) ||
    empty($suburbTown) ||
    empty($state) ||
    empty($postcode) ||
    empty($email) ||
    empty($phoneNumber)
) {
    die("Please complete all required fields.");
}

// Validate input formats
if (
    !preg_match("/^[a-zA-Z ]{1,20}$/", $firstName) ||
    !preg_match("/^[a-zA-Z ]{1,20}$/", $lastName) ||
    strlen($streetAddress) > 40 ||
    strlen($suburbTown) > 40 ||
    !preg_match("/^[0-9]{4}$/", $postcode) ||
    !preg_match("/^[0-9]{8,12}$/", $phoneNumber) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    die("Invalid input format. Please check your information.");
}

// Validate date of birth, gender and state
$dateParts = explode("/", $dateOfBirth);

if (
    count($dateParts) != 3 ||
    !checkdate((int)$dateParts[1], (int)$dateParts[0], (int)$dateParts[2]) ||
    !in_array($gender, ['male', 'female']) ||
    !in_array($state, ['vic', 'nsw', 'qld', 'nt', 'wa', 'sa', 'tas', 'act'])
) {
    die("Invalid date of birth, gender or state.");
}

    // SQL statement
    $sql = "INSERT INTO eoi (jobRefNum, firstName, lastName, dateOfBirth, gender, streetAddress, suburbTown, state, postcode, email, phoneNumber, skills, otherSkills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // prepare SQL statement
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
    die("Database query preparation failed.");
}

    // bind parameters
    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssss",
        $jobRefNum,
        $firstName,
        $lastName,
        $dateOfBirth,
        $gender,
        $streetAddress,
        $suburbTown,
        $state,
        $postcode,
        $email,
        $phoneNumber,
        $skills,
        $otherSkills
    );

    // execute SQL statement
    if (mysqli_stmt_execute($stmt)) {

        // generate eoi number
        $eoiNumber = mysqli_insert_id($conn);

        // Display confirmation and EOI number
        $safeFirstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');

        echo "<h2>Application submitted successfully!</h2>";
        echo "<p>Thank you, " . $safeFirstName . "!</p>";
        echo "<p>Your EOI number is: <strong>" . $eoiNumber . "</strong></p>";
    }
    
    else {
        echo "<h2>Application failed to submit.</h2>";
    }
    
    // close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
</body>
</html>