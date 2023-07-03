<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
</head>
<body>
    <?php
    echo "Test";
    require_once "../Models/DbConnect.ini.php";
    $database = New Connect_Database();
    $result = $database->SelectTable("","Users","");
    print_r ($result);
    // $con = new mysqli("localhost:3306","root","root","orderfoodonline");
    // $result = $con->query("SELECT * FROM Users");
    // $row = $result->fetch_assoc();
    // echo htmlentities($row['NameAll'])
    ?>
</body>
</html>