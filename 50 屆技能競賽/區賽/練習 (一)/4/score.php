<?php
    include '../connect.php';
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM `score` WHERE comment_id = $_SESSION[comment] AND user_id = {$_SESSION["user"]["id"]}")))
        header("Location:index.php"); // 以評分過，返回頁面。
    if (!empty($_POST)){
        $_POST['user_id'] = $_SESSION["user"]["id"];
        $_POST['comment_id'] = $_SESSION["comment"];
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
        $SQL = join(" Values ",$SQL);
        mysqli_query($db, "INSERT INTO `score` $SQL");
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評分</title>
</head>
<body>
    <form action="" method="post">
        <span>分數：</span><input type="number" required min="1" max="5" value="3" name="score"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='index.php'">返回</button>
</body>
</html>