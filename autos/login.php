<?php
session_start();
$message = "";
if (isset($_POST["email"]) and isset($_POST["pass"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $salt = "XyZzy12*_";
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is php123
    $md5 = hash('md5', $salt . $password);
    echo "hello";
    if ($md5 === $stored_hash) {
        $_SESSION["name"] = $email;
        $_SESSION["success"] = true;
        header("location:view.php");
        return;
    } else {
        $_SESSION["error"] = "Incorrect password";
        header("location:login.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rohith k 1ab73295</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="text" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="pass" name="pass" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Log In">
            </div>
            <?php
            if (isset($_SESSION["error"])) {
                echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) .  "</p>");
                unset($_SESSION['error']);
            }
            ?>
        </form>
    </div>
</body>

</html>