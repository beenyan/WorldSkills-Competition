<?php
    include '../connect.php';
    // $index = (empty($_GET["index"])? 0: $_GET["index"]);
    // $sort = array("ASC","DESC")[$index];
    // $arr = mysqli_query($db, "SELECT * FROM `User` ORDER BY `account` $sort");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案管理</title>
</head>

<body>
    <button onclick="location.href='Project_add.php'">新增</button>
</body>

</html>