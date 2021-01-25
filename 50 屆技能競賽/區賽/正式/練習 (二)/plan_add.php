<?php
include "connect.php";
if (!empty($_POST)) {
    $_POST['project_id'] = $_SESSION['project_id'];
    $name = "(" . join(',', array_keys($_POST)) . ")";
    $val = "(\"" . join('","', array_values($_POST)) . "\")";
    // 新增資料庫
    // echo "INSERT INTO plan $name VALUES $val<br>";
    mysqli_query($db, "INSERT INTO plan $name VALUES $val");
    echo "新增成功";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>執行方案新增</title>
</head>
<body align="center">
    <form action="" method="post">
        Name：<input type="text" name="name" required><br><br>
        Detail：<input type="text" name="detail" required><br><br>
        開始評分：<input type="checkbox" name="mode" value="1"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='leader.php'">Back</button>
</body>
</html>
