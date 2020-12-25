<?php
    include '../connect.php';
    if (!empty($_POST)){
        // 檢查重複
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) !== "member_") continue;
            else if ($value === $_POST['leader']) {
                echo "組長、組員重複";
                goto out;
            }
        }
        // 新增專案
        $SQL = array(
            "key"=>array(),
            "value"=>array()
        );
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) === "member_") continue;
            array_push($SQL["key"],"`$key`");
            array_push($SQL["value"],"'$value'");
        }
        foreach ($SQL as $key => $value) {
            $SQL[$key] = "(".join(' , ',$value).")";
        }
        $SQL = join(" Values ",$SQL);
        mysqli_query($db, "INSERT INTO `project` $SQL");
    
        // 新增成員
        $last_id = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `project` ORDER BY `id` DESC LIMIT 1"))["id"];
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) !== "member_") continue;
            array_push($SQL,"(".join(",",array($last_id,$value)).")");
        }
        $SQL = join(",",$SQL);
        mysqli_query($db, "INSERT INTO `member` (`project_id`,`user_id`) VALUES $SQL");
        echo "新增成功";
    }
    out:
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案新增</title>
</head>

<body>
    <form id="form" action="" method="POST">
        <span>name：</span><input required type="text" name="name"><br><br>
        <span>detail：</span><input required type="text" name="detail"><br><br>
        <table border="1" width="600" cellpadding="5" align="center">
            <tr>
                <td width="10%">Leader：</td>
                <td>
                    <?php
                        $arr = mysqli_query($db, "SELECT * FROM `user`");
                        while ($row = mysqli_fetch_array($arr)){
                            echo "<input required type='radio' name='leader' value='$row[id]' id='leader_$row[id]'>
                                <label for='leader_$row[id]'>$row[name]</label> ";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td width="10%">Member：</td>
                <td>
                    <?php
                        $arr = mysqli_query($db, "SELECT * FROM `user`");
                        while ($row = mysqli_fetch_array($arr)){
                            echo "<input type='checkbox' name='member_$row[id]' value='$row[id]' id='member_$row[id]'>
                                <label for='member_$row[id]'>$row[name]</label> ";
                        }
                    ?>
                </td>
            </tr>
        </table>
        <input type="submit">
    </form>
</body>

</html>