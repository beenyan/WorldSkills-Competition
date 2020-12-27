<?php
    include '../connect.php';
    if (!empty($_POST)){
        // 檔案傳入
        if (!$_FILES["file"]["error"]){
            $type = preg_split("/[\/]/",$_FILES["file"]["type"])[0]; // 資料形式
            $path = preg_split("/[.]/",$_FILES["file"]["name"]);
            $path = "../file/".date("Y-m-d_").strtotime(date("h:m:s")).".".end($path); // 資料路徑
            // move_uploaded_file(暫存位置, 儲存位置);
            move_uploaded_file($_FILES["file"]["tmp_name"], $path);
            $_POST["type"] = $type;
            $_POST["file"] = $path;
        }
        $_POST["user_id"] = $_SESSION['user']["id"];
        $_POST["side_id"] = $_SESSION['side'];
        $_POST["time"] = date("Y-m-d");
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
        mysqli_query($db, "INSERT INTO `comment` $SQL");
        echo "新增成功";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        a {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <title>新增意見</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <span>Title：</span><input required type="text" name="title"><br><br>
        <span>Detail：</span><input required type="text" name="detail"><br><br>
        <input type="file" accept="image/*,video/*,audio/*" name="file"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='index.php'">返回</button>
</body>

</html>