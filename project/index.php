<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rohith k PHP 1833d0bd</title>
    <link href="starter.css" rel="stylesheet">
</head>

<body>
    <h1>
        Welcome to AUTOS Database
    </h1>
    <?php
    require_once "pdo.php";
    $stmt = $pdo->query("select * from users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row["user_id"]);
        echo "\n";
    }
    ?>
</body>

</html>