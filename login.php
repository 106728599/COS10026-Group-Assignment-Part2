
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ece5f3;
        }

        .login-box {
            width: 350px;
            max-width: 90%;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ccc;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }


    .back-btn {
        display: block;
        text-align: center;
        margin-top: 15px;
        padding: 10px;
        background: #eeeeee;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }

.back-btn:hover {
    background: #dddddd;
}

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #87719a;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover{
            background: #6f5c82;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
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
