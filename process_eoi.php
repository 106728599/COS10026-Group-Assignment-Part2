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

    // retrieve data 
    $jobRefNum = $_POST['jobRefNum'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $streetAddress = $_POST['streetAddress'];
    $suburbTown = $_POST['suburbTown'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $skills = implode(", ", $_POST['skills'] ?? []);
    $otherSkills = $_POST['otherSkills'];

    // SQL statement
    $sql = "INSERT INTO eoi (jobRefNum, firstName, lastName, dateOfBirth, gender, streetAddress, suburbTown, state, postcode, email, phoneNumber, skills, otherSkills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // prepare SQL statement
    $stmt = mysqli_prepare($conn, $sql);

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
        echo "Application submitted successfully!";
    }
    
    else {
        echo "Application failed to submit.";
    }
    
    // close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
</body>
</html>