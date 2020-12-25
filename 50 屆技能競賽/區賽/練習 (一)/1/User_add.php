<?php
    include '../connect.php';
    $SQL = array(
        "key"=>array(),
        "value"=>array()
    );
    foreach ($_POST as $key => $value) {
        array_push($SQL["key"],"`$key`");
        array_push($SQL["value"],"'$value'");
    }
    foreach ($SQL as $key => $value) {
        $SQL[$key] = "(".join(' , ',$value).")";
    }
    if ($SQL["key"] != "()"){ // 判斷是否有資料(POST)
        $SQL = join(" Values ",$SQL);
        if ($row = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `User` WHERE `account` Like '$_POST[account]'")))
            echo "帳號重複";
        else {
            mysqli_query($db, "INSERT INTO `user` $SQL");
            echo "新增成功";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者新增</title>
</head>

<body>
    <form action="" method="POST">
        <span>Name：</span><input required type="text" name="name"><br>
        <span>Account：</span><input required type="text" name="account"><br>
        <span>Password：</span><input required type="password" name="password"><br>
        <input type="submit">
    </form>
    <button onclick="location.href='User.php'">返回</button>
</body>

</html>