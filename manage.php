
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once "settings.php";

$message = "";

if (isset($_POST['update'])) {
    $eoi = (int)($_POST['eoi'] ?? 0);
    $status = $_POST['status'] ?? '';

    if ($eoi > 0 && in_array($status, ['New', 'Current', 'Final'])) {
        $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
        $stmt->bind_param("si", $status, $eoi);

        if ($stmt->execute()) {
            $message = "Status updated successfully.";
        } else {
            $message = "Unable to update status.";
        }

        $stmt->close();
    }
}

if (isset($_POST['delete'])) {
    $deleteJob = trim($_POST['delete_job'] ?? '');

    if ($deleteJob != "") {
        $stmt = $conn->prepare("DELETE FROM eoi WHERE job_reference = ?");
        $stmt->bind_param("s", $deleteJob);

        if ($stmt->execute()) {
            $message = "Applications deleted successfully.";
        } else {
            $message = "Unable to delete applications.";
        }

        $stmt->close();
    }
}

$job = trim($_GET['job'] ?? '');
$name = trim($_GET['name'] ?? '');
$sort = $_GET['sort'] ?? 'EOInumber';

$allowedSort = [
    'EOInumber',
    'job_reference',
    'first_name',
    'last_name',
    'status'
];

if (!in_array($sort, $allowedSort)) {
    $sort = 'EOInumber';
}

$sql = "SELECT * FROM eoi WHERE 1=1";

if ($job != "") {
    $sql .= " AND job_reference = ?";
}

if ($name != "") {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR CONCAT(first_name, ' ', last_name) LIKE ?)";
}

$sql .= " ORDER BY $sort ASC";

$stmt = $conn->prepare($sql);

if ($job != "" && $name != "") {
    $searchName = "%" . $name . "%";
    $stmt->bind_param("ssss", $job, $searchName, $searchName, $searchName);
} elseif ($job != "") {
    $stmt->bind_param("s", $job);
} elseif ($name != "") {
    $searchName = "%" . $name . "%";
    $stmt->bind_param("sss", $searchName, $searchName, $searchName);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Manager - TRAVEXA</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 0;
        }

        .manager {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .manager-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .manager-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .manager-brand img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .manager-brand h1 {
            margin: 0;
            color: #17324D;
        }

        .manager-brand p {
            margin: 5px 0;
            color: #6F568E;
        }

        .logout-btn,
        .manager button,
        .view-btn {
            display: inline-block;
            background: #B19ACB;
            color: #17324D;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover,
        .manager button:hover,
        .view-btn:hover {
            background: #9B82BB;
        }

        .section {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .manager form {
            max-width: none;
            margin: 10px 0;
            padding: 10px;
        }

        .manager input,
        .manager select {
            padding: 8px;
            margin: 5px;
        }

        .table-box {
            overflow-x: auto;
        }

        .manager table {
            width: 100%;
            min-width: 950px;
            table-layout: auto;
            border-collapse: collapse;
        }

        .manager th,
        .manager td {
            width: auto;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
            word-break: normal;
            overflow-wrap: normal;
        }

        .manager th {
            background: #eee;
            white-space: nowrap;
        }

        .manager td form {
            padding: 0;
            margin: 0;
            min-width: 150px;
        }

        .manager td select {
            width: auto;
        }

        .view-btn {
            white-space: nowrap;
        }
    </style>
</head>

<body>

<main class="manager">

    <div class="manager-header">
        <div class="manager-brand">
            <img src="Images/Company Logo.png" alt="TRAVEXA Logo">

            <div>
                <h1>TRAVEXA</h1>
                <p>HR Management Dashboard</p>
            </div>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <h3>
        Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!
    </h3>

    <?php if ($message != "") { ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>

    <div class="section">
        <h2>Search Applications</h2>

        <form method="get" action="manage.php">

            <label for="job">Job Reference:</label>
            <input type="text" id="job" name="job"
                value="<?php echo htmlspecialchars($job); ?>">

            <label for="name">Applicant Name:</label>
            <input type="text" id="name" name="name"
                value="<?php echo htmlspecialchars($name); ?>">

            <label for="sort">Sort By:</label>

            <select id="sort" name="sort">
                <option value="EOInumber" <?php if ($sort == 'EOInumber') echo 'selected'; ?>>EOI Number</option>
                <option value="job_reference" <?php if ($sort == 'job_reference') echo 'selected'; ?>>Job Reference</option>
                <option value="first_name" <?php if ($sort == 'first_name') echo 'selected'; ?>>First Name</option>
                <option value="last_name" <?php if ($sort == 'last_name') echo 'selected'; ?>>Last Name</option>
                <option value="status" <?php if ($sort == 'status') echo 'selected'; ?>>Status</option>
            </select>

            <button type="submit">Search</button>
            <a href="manage.php">Show All</a>

        </form>
    </div>

    <div class="section">
        <h2>Delete Applications by Job Reference</h2>

        <form method="post" action="manage.php">

            <label for="delete_job">Job Reference:</label>
            <input type="text" id="delete_job" name="delete_job" required>

            <button type="submit" name="delete">Delete Applications</button>

        </form>
    </div>

    <div class="section">
        <h2>Job Applications</h2>

        <div class="table-box">
            <table>
                <tr>
                    <th>EOI Number</th>
                    <th>Job Reference</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Update</th>
                </tr>

                <?php if ($result->num_rows > 0) { ?>

                    <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars((string)$row['EOInumber']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_reference']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>

                        <td>
                            <a class="view-btn"
                               href="view_eoi.php?eoi=<?php echo (int)$row['EOInumber']; ?>">
                                View Details
                            </a>
                        </td>

                        <td>
                            <form method="post" action="manage.php">

                                <input type="hidden" name="eoi"
                                    value="<?php echo (int)$row['EOInumber']; ?>">

                                <select name="status">
                                    <option value="New" <?php if ($row['status'] == 'New') echo 'selected'; ?>>New</option>
                                    <option value="Current" <?php if ($row['status'] == 'Current') echo 'selected'; ?>>Current</option>
                                    <option value="Final" <?php if ($row['status'] == 'Final') echo 'selected'; ?>>Final</option>
                                </select>

                                <button type="submit" name="update">Update</button>

                            </form>
                        </td>
                    </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="9">No applications found.</td>
                    </tr>

                <?php } ?>

            </table>
        </div>
    </div>

</main>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
