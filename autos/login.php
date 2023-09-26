<?php
$message = "";
if (isset($_POST["who"]) and isset($_POST["password"])) {
    $username = $_POST["who"];
    $password = $_POST["password"];
    if ($username != "" and $password != "") {
        $salt = "XyZzy12*_";
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is php123
        $md5 = hash('md5', $salt . $password);
        if ($md5 === $stored_hash) {
            error_log("Login success" . $_POST['who']);
            header("location:autos.php?name=" . urlencode($_POST["who"]));
        } else {
            error_log("Login fail" . $_POST['who'] . $stored_hash);
            $message = "Incorrect password";
        }
    } else {
        $message = "Email and password are required";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
                <input type="email" id="email" name="who" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <?php
            if ($message) echo $message
            ?>
        </form>
    </div>
</body>

</html>