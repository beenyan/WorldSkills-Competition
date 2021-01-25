<?php
include "connect.php";
if (!empty($_POST)) {
    $_POST['project_id'] = $_SESSION['project_id'];
    $name = "(" . join(',', array_keys($_POST)) . ")";
    $val = "(\"" . join('","', array_values($_POST)) . "\")";
    // 新增資料庫
    // echo "INSERT INTO `leader` $name VALUES $val<br>";
    mysqli_query($db, "INSERT INTO `leader` $name VALUES $val");
    echo "新增成功";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>評分新增</title>
</head>
<body align="center">
    <form action="" method="post">
    Name：<input type="text" required name="name"><br><br>
    <input type="submit">
    </form>
    <button onclick="location.href='leader.php'">Back</button>
</body>
</html>
