
<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: manage.php");
    exit();
}

$error = isset($_GET['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Creating a website for a Travel & Tourism Technology Company">
    <meta name="keywords" content="reference number, job title, salary, responsibilities, requirements">
    <meta name="author" content="Soo Kian Meng, Pang Hui Xin, Jarome Loo, Lee Xiao Yan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - TRAVEXA</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="login-box">

    <h2>Admin Login</h2>

    <?php if ($error) { ?>
        <p class="error">
            Invalid username or password.
        </p>
    <?php } ?>

    <form action="process_login.php" method="post">

        <label for="username">Username</label>
        <input type="text"
               id="username"
               name="username"
               required>

        <label for="password">Password</label>
        <input type="password"
               id="password"
               name="password"
               required>

        <a href="index.php" class="back-btn">
            ← Back to Home
        </a>

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>
