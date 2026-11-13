<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once "settings.php";

$eoi = (int)($_GET['eoi'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM eoi WHERE EOInumber = ?");
$stmt->bind_param("i", $eoi);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Details - TRAVEXA</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container">
    <div class="details-box">

        <h1>TRAVEXA</h1>
        <h2>Applicant Details</h2>

        <?php if ($row) { ?>

            <p><strong>EOI Number:</strong>
                <?php echo htmlspecialchars((string)($row['EOInumber'] ?? '')); ?>
            </p>

            <p><strong>Job Reference:</strong>
                <?php echo htmlspecialchars($row['job_reference'] ?? ''); ?>
            </p>

            <p><strong>First Name:</strong>
                <?php echo htmlspecialchars($row['first_name'] ?? ''); ?>
            </p>

            <p><strong>Last Name:</strong>
                <?php echo htmlspecialchars($row['last_name'] ?? ''); ?>
            </p>

            <p><strong>Date of Birth:</strong>
                <?php echo htmlspecialchars($row['date_of_birth'] ?? ''); ?>
            </p>

            <p><strong>Gender:</strong>
                <?php echo htmlspecialchars($row['gender'] ?? ''); ?>
            </p>

            <p><strong>Street Address:</strong>
                <?php echo htmlspecialchars($row['street_address'] ?? ''); ?>
            </p>

            <p><strong>Suburb/Town:</strong>
                <?php echo htmlspecialchars($row['suburb_town'] ?? ''); ?>
            </p>

            <p><strong>State:</strong>
                <?php echo htmlspecialchars($row['state'] ?? ''); ?>
            </p>

            <p><strong>Postcode:</strong>
                <?php echo htmlspecialchars($row['postcode'] ?? ''); ?>
            </p>

            <p><strong>Email:</strong>
                <?php echo htmlspecialchars($row['email'] ?? ''); ?>
            </p>

            <p><strong>Phone:</strong>
                <?php echo htmlspecialchars($row['phone'] ?? ''); ?>
            </p>

            <p><strong>Skills:</strong>
                <?php echo htmlspecialchars($row['skills'] ?? ''); ?>
            </p>

            <p><strong>Other Skills:</strong>
                <?php echo htmlspecialchars($row['other_skills'] ?? ''); ?>
            </p>

            <p><strong>Status:</strong>
                <?php echo htmlspecialchars($row['status'] ?? ''); ?>
            </p>

        <?php } else { ?>

            <p>Application not found.</p>

        <?php } ?>

        <a href="manage.php" class="back-btn">Back to HR Manager</a>

    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
