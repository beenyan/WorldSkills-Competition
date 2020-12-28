<?php
    include '../connect.php';
    $id = $_GET['id'];
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $id")) >= 10){
        echo "面相超過10個<br><button onclick=\"location.href='Side.php?id=$id'\">返回</button>";
        return;
    }
    $_POST['project_id'] = $id;
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
    if ($SQL["key"] != "(`project_id`)"){ // 判斷是否有資料(POST)
        $SQL = join(" Values ",$SQL);
        mysqli_query($db, "INSERT INTO `side` $SQL");
        echo "新增成功";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>面向新增</title>
</head>

<body>
    <form action="" method="POST">
        <span>Name：</span><input required type="text" name="name"><br>
        <span>Detail：</span><input required type="text" name="detail"><br>
        <input type="submit">
    </form>
    <button onclick="location.href='Side.php?id=<?php echo $id;?>'">返回</button>
</body>

</html>