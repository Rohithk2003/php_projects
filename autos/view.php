<?php
session_start();
require_once 'pdo.php';
if (!isset($_SESSION["name"])) die("Not logged in");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rohith k 1ab73295</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #cccccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        body {
            font-family: 'Open Sans', sans-serif;

        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION["success"])) {
        echo ('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION["success"]);
    }
    ?>
    <table style="border:1px solid black">
        <tr style="border:1px solid black">
            <td>
                make
            </td>
            <td>
                year
            </td>
            <td>
                mileage
            </td>
        </tr>
        <?php
        $stmt = $pdo->query("select * from autos order by make");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td><b>";
            echo htmlentities($row["make"]);
            echo "</b></td>;
            <td>" . $row["year"] . "</td>
            <td>" . $row["mileage"] . "</td>
            </tr>";
        }
        ?>
    </table>
    <a href='logout.php'>Logout</a>
    <a href="add.php">Add New</a>
</body>

</html>