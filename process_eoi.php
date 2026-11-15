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

<?php include 'header.inc'; ?>

<main class="eoi-page">


<?php
    // connect to database using settings.php
    require_once 'settings.php';
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
$errors = [];

$allowedSkills = ['html', 'css', 'javaScript', 'php', 'mysql'];
$selectedSkills = $_POST['skills'] ?? [];

if (!is_array($selectedSkills)) {
    $errors[] = "Skills: Invalid selection.";
    $selectedSkills = [];
} else {
    foreach ($selectedSkills as $skill) {
        if (!is_string($skill) || !in_array($skill, $allowedSkills, true)) {
            $errors[] = "Skills: Invalid selection.";
            $selectedSkills = [];
            break;
        }
    }
}

$skills = implode(", ", $selectedSkills);

$otherSkills = trim(stripslashes($_POST['otherSkills'] ?? ''));

// Validate Job Reference Number
if ($jobRefNum == '') {
    $errors[] = "Job Reference Number: This field is required.";
} 

else {
    $checkJobStmt = mysqli_prepare($conn, "SELECT 1 FROM jobs WHERE `Reference Number` = ?");
    if ($checkJobStmt) {
        mysqli_stmt_bind_param($checkJobStmt, "s", $jobRefNum);
        mysqli_stmt_execute($checkJobStmt);
        mysqli_stmt_store_result($checkJobStmt);

        if (mysqli_stmt_num_rows($checkJobStmt) === 0) {
            $errors[] = "Job Reference Number: Invalid job reference number.";
        }
        mysqli_stmt_close($checkJobStmt);
    } else {
        die("Database query preparation failed.");
    }
}

// Validate First Name
if ($firstName == '') {
    $errors[] = "First Name: This field is required.";
} elseif (!preg_match("/^[a-zA-Z ]{1,20}$/", $firstName)) {
    $errors[] = "First Name: Only letters and spaces are allowed (maximum 20 characters).";
}

// Validate Last Name
if ($lastName == '') {
    $errors[] = "Last Name: This field is required.";
} elseif (!preg_match("/^[a-zA-Z ]{1,20}$/", $lastName)) {
    $errors[] = "Last Name: Only letters and spaces are allowed (maximum 20 characters).";
}

// Validate Date of Birth
if ($dateOfBirth == '') {
    $errors[] = "Date of Birth: This field is required.";
} elseif (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19[0-9]{2}|[2-9][0-9]{3})$/", $dateOfBirth)) {
    $errors[] = "Date of Birth: Please use DD/MM/YYYY format.";
} else {
    $dateParts = explode("/", $dateOfBirth);

   if (
    !checkdate((int)$dateParts[1], (int)$dateParts[0], (int)$dateParts[2]) ||
    mktime(0, 0, 0, (int)$dateParts[1], (int)$dateParts[0], (int)$dateParts[2]) > strtotime('today')
) {
    $errors[] = "Date of Birth: Please enter a valid date.";
}
}

// Validate Gender
if ($gender == '') {
    $errors[] = "Gender: Please select your gender.";
} elseif (!in_array($gender, ['male', 'female'], true)) {
    $errors[] = "Gender: Invalid selection.";
}

// Validate Street Address
if ($streetAddress == '') {
    $errors[] = "Street Address: This field is required.";
} elseif (strlen($streetAddress) > 40) {
    $errors[] = "Street Address: Maximum 40 characters allowed.";
}

// Validate Suburb/Town
if ($suburbTown == '') {
    $errors[] = "Suburb/Town: This field is required.";
} elseif (strlen($suburbTown) > 40) {
    $errors[] = "Suburb/Town: Maximum 40 characters allowed.";
}

// Validate State
if ($state == '') {
    $errors[] = "State: Please select your state.";
} elseif (!in_array($state, ['vic', 'nsw', 'qld', 'nt', 'wa', 'sa', 'tas', 'act'], true)) {
    $errors[] = "State: Invalid selection.";
}

// Validate Postcode
if ($postcode == '') {
    $errors[] = "Postcode: This field is required.";
} elseif (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode: Must contain exactly 4 digits.";
}

// Validate Email
if ($email == '') {
    $errors[] = "Email: This field is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email: Please enter a valid email address.";
}

// Validate Phone Number
if ($phoneNumber == '') {
    $errors[] = "Phone Number: This field is required.";
} elseif (!preg_match("/^[0-9]{8,12}$/", $phoneNumber)) {
    $errors[] = "Phone Number: Must contain 8 to 12 digits.";
}

// Display all validation errors
if (!empty($errors)) {
    echo "<div class='eoi-card error-card'>";
    echo "<h2>Application Submission Failed</h2>";
    echo "<p>Please correct the following errors:</p>";
    echo "<ul class='error-list'>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
    }

    echo "</ul>";
    echo "<a href='javascript:history.back()' class='eoi-button'>Back to Application</a>";
    echo "</div>";

    mysqli_close($conn);

    echo "</main>";
    include 'footer.inc';
    exit();
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

        echo "<div class='eoi-card success-card'>";
        echo "<div class='success-icon'>&#10003;</div>";
        echo "<h2>Application Submitted Successfully!</h2>";
        echo "<p>Thank you, " . $safeFirstName . "!</p>";
        echo "<p>Your application has been received successfully.</p>";

        echo "<div class='eoi-number'>";
        echo "<p>Your EOI Number</p>";
        echo "<strong>" . $eoiNumber . "</strong>";
        echo "</div>";

        echo "<a href='index.php' class='eoi-button'>Back to Home</a>";
        echo "</div>";
    }
    
    else {
    echo "<div class='eoi-card error-card'>";
    echo "<h2>Application Failed to Submit</h2>";
    echo "<p>Sorry, your application could not be submitted. Please try again later.</p>";
    echo "<a href='javascript:history.back()' class='eoi-button'>Back to Application</a>";
    echo "</div>";
}
    
    // close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>

    </main>

    <?php include 'footer.inc'; ?>

    </body>
    </html>