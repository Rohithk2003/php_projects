<?php
$message = "";
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    echo "Welcome " . $name;
    require_once "pdo.php";
} else {
    die("Name parameter missing");
}

if (isset($_POST["make"]) and isset($_POST["year"]) and isset($_POST["mileage"])) {
    echo $_POST["submit"];
    if (isset($_POST["logout"])) {
        header("Location: index.php");
        return;
    }
    $make  = $_POST["make"];
    $year = $_POST["year"];
    $mileage = $_POST["mileage"];
    if (is_numeric($year) and is_numeric($mileage)) {
        if (strlen($make) >= 1) {
            $stmt = $pdo->prepare("insert into autos(make,year,mileage) values(:mk,:yr,:mi)");
            $stmt->execute(array(
                ':mk' => $make, ':yr' => $year, ':mi' => $mileage
            ));
            $message = "Record inserted";
        } else {
            $message = "Make is required";
        }
    } else {
        $message = "Mileage and year must be numeric";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rohith k 1ab73295</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
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
    <h1>Add an automobile</h1>
    <form method="post">
        <div class="form-group">
            <label for="make">Make:</label>
            <input type="text" id="make" name="make" placeholder="Enter car make">
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" placeholder="Enter car year">
        </div>
        <div class="form-group">
            <label for="mileage">Mileage:</label>
            <input type="number" id="mileage" name="mileage" placeholder="Enter car mileage">
        </div>
        <button type="submit" name="add">Add</button>
        <button type="submit" name="logout">logout</button>
        <?php
        if ($message === "Record inserted") {
            echo "<span style='color:green'>$message</span>";
        } else {
            echo $message;
        }
        ?>
    </form>
</body>

</html>