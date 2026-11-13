
<?php
session_start();

require_once "settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);
        $_SESSION['admin'] = $user['username'];

        header("Location: manage.php");
        exit();

    } else {

        header("Location: login.php?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {

    header("Location: login.php");
    exit();
}
?>
