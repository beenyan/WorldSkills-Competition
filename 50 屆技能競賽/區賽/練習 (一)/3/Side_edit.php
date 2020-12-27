<?php
    include '../connect.php';
    $id = $_SESSION['project'];
    $side = $_SESSION['side'];
    // 修改
    $SQL = array();
    foreach ($_POST as $key => $value) {
        if ($key == "id") continue;
        array_push($SQL,"`$key` = '$value'");
    }
    if (count($SQL)){ // 判斷是否有資料(POST)
        $SQL = join(" , ",$SQL);
        mysqli_query($db, "UPDATE `side` SET $SQL WHERE `id` = $side");
        echo "修改成功";
    }

    // 顯示
    $row = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `side` WHERE id = $side"));
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
        <input type="hidden" name="id" value="<?php echo "$side";?>">
        <span>Name：</span><input type="text" require name="name" value="<?php echo "$row[name]";?>"><br><br>
        <span>Detail：</span><input type="text" require name="detail" value="<?php echo "$row[detail]";?>"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='Side.php'">返回</button>
</body>

</html>