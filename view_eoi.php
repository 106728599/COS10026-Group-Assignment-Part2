<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once "settings.php";

$eoi = (int)($_GET['eoi'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM eoi WHERE EOINumber = ?");
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
    <style>
        body {
            padding-top: 0;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 20px;
        }

        .details-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .details-box h1 {
            color: #17324D;
        }

        .details-box h2 {
            color: #6F568E;
        }

        .details-box p {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            overflow-wrap: anywhere;
        }

        .details-box strong {
            display: inline-block;
            min-width: 160px;
        }

        .back-btn {
            display: inline-block;
            background: #B19ACB;
            color: #17324D;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-btn:hover {
            background: #9B82BB;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="details-box">

        <h1>TRAVEXA</h1>
        <h2>Applicant Details</h2>

        <?php if ($row) { ?>

            <p><strong>EOI Number:</strong>
                <?php echo htmlspecialchars((string)($row['EOINumber'] ?? '')); ?>
            </p>

            <p><strong>Job Reference:</strong>
                <?php echo htmlspecialchars($row['jobRefNum'] ?? ''); ?>
            </p>

            <p><strong>First Name:</strong>
                <?php echo htmlspecialchars($row['firstName'] ?? ''); ?>
            </p>

            <p><strong>Last Name:</strong>
                <?php echo htmlspecialchars($row['lastName'] ?? ''); ?>
            </p>

            <p><strong>Date of Birth:</strong>
                <?php echo htmlspecialchars($row['dateOfBirth'] ?? ''); ?>
            </p>

            <p><strong>Gender:</strong>
                <?php echo htmlspecialchars($row['gender'] ?? ''); ?>
            </p>

            <p><strong>Street Address:</strong>
                <?php echo htmlspecialchars($row['streetAddress'] ?? ''); ?>
            </p>

            <p><strong>Suburb/Town:</strong>
                <?php echo htmlspecialchars($row['suburbTown'] ?? ''); ?>
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
                <?php echo htmlspecialchars($row['phoneNumber'] ?? ''); ?>
            </p>

            <p><strong>Skills:</strong>
                <?php echo htmlspecialchars($row['skills'] ?? ''); ?>
            </p>

            <p><strong>Other Skills:</strong>
                <?php echo htmlspecialchars($row['otherSkills'] ?? ''); ?>
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
