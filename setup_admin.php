
<?php
require_once "settings.php";

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

$conn->query($sql);

$username = "admin";
$password = "admin";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (username, password)
     VALUES (?, ?)
     ON DUPLICATE KEY UPDATE password = ?"
);

$stmt->bind_param(
    "sss",
    $username,
    $hashed_password,
    $hashed_password
);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Error creating admin account.";
}

$stmt->close();
$conn->close();
?>
