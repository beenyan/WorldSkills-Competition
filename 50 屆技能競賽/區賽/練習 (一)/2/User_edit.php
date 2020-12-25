<?php
    include '../connect.php';
    // 修改
    $SQL = array();
    foreach ($_POST as $key => $value) {
        if ($key == "id") continue;
        array_push($SQL,"`$key` = '$value'");
    }
    if (count($SQL)){ // 判斷是否有資料(POST)
        $SQL = join(" , ",$SQL);
        mysqli_query($db, "UPDATE `user` SET $SQL WHERE `id` = $_POST[id]");
        echo "修改成功";
    }

    // 顯示
    $SQL = array();
    foreach ($_GET as $key => $value) {
        array_push($SQL,"`$key` LIKE '$value'");
    }
    if (count($SQL)){ // 判斷是否有資料(GET)
        $SQL = join(" AND ",$SQL);
        $arr = mysqli_query($db, "SELECT * FROM `User` WHERE $SQL");
        $row = mysqli_fetch_array($arr);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者修改</title>
</head>

<body>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo "$row[id]";?>">
        <span>Name：</span><input type="text" require name="name" value="<?php echo "$row[name]";?>"><br><br>
        <span>Password：</span><input type="text" require name="password" value="<?php echo "$row[password]";?>"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='index.php'">返回</button>
</body>

</html>