<?php
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    echo "Welcome " . $name;
} else {
    echo "testing";
    die("Name parameter missing");
}
if (isset($_POST["make"]) and isset($_POST["year"]) and isset($_POST["mileage"])) {
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
!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
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
        require_once "pdo.php";
        $stmt = $pdo->query("select * from autos");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
            <td>" . $row["make"] . "</td>
            <td>" . $row["year"] . "</td>
            <td>" . $row["mileage"] . "</td>
            </tr>";
        }
        ?>
    </table>
    <h1>Add an automobile</h1>
    <form action="autos.php" method="POST">
        <input type="text" name="make">
        <input type="number" name="year">
        <input type="mileage" name="mileage">
        <input type="submit" value="Add">
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