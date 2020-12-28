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
            if (substr($key,0,8) === "comment_") continue;
            array_push($SQL["key"],"`$key`");
            array_push($SQL["value"],"'$value'");
        }
        foreach ($SQL as $key => $value) {
            $SQL[$key] = "(".join(' , ',$value).")";
        }
        $SQL = join(" Values ",$SQL);
        mysqli_query($db, "INSERT INTO `comment` $SQL");

        // 延伸意見
        $last_id = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 1"))["id"];
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,8) !== "comment_") continue;
            array_push($SQL,"(".join(",",array($last_id,$value)).")");
        }
        $SQL = join(",",$SQL);
        // echo "INSERT INTO `comment_stratch` (`comment_id`,`comment_stratch`) VALUES $SQL";
        mysqli_query($db, "INSERT INTO `comment_stratch` (`comment_id`,`comment_stratch`) VALUES $SQL");
        echo "新增成功";
    }
    $arr = mysqli_query($db, "SELECT * FROM `comment`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .table_title td {
            background-color: wheat;
        }
    </style>
    <title>意見延伸</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table border="1" cellpadding="15" align="center">
            <tr>
                <td>延伸</td>
                <td>標題</td>
                <td>內容</td>
            </tr>
            <?php
                while ($row = mysqli_fetch_array($arr)){
                    echo "<tr class='table_title'>";
                    echo "<td><input type='checkbox' value='$row[id]' name='comment_$row[0]'></td>";
                    for ($i = 1; $i <= 2; ++$i){
                        echo "<td>$row[$i]</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        <br><br>
        <span>Title：</span><input required type="text" name="title"><br><br>
        <span>Detail：</span><input required type="text" name="detail"><br><br>
        <input type="file" accept="image/*,video/*,audio/*" name="file"><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='index.php'">返回</button>
</body>

</html>