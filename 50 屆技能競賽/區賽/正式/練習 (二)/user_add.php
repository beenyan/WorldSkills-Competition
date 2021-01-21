<?php
include "connect.php";
if (!empty($_POST)) {
    $name = "(" . join(',', array_keys($_POST)) . ")";
    $val = "('" . join("','", array_values($_POST)) . "')";
    // 新增資料庫
    // echo "INSERT INTO user $name VALUES $val<br>";
    mysqli_query($db, "INSERT INTO user $name VALUES $val");
    echo "新增成功";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者新增</title>
</head>
<body align="center">
    <form action="" method="post">
        Name：<input type="text" name="name"><br><br>
        Account：<input type="text" name="account"><br><br>
        Password：<input type="text" name="password"><br><br>
        <input type="submit">
    </form>
    <button><a href="user.php">Back</a></button>
</body>
</html>
