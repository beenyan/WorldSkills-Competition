<?php
    include '../connect.php';
    $id = $_GET['id'];
    if (!empty($_POST)){
        // 檢查重複
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) !== "member_") continue;
            else if ($value === $_POST['leader']) {
                echo "組長、組員重複";
                goto out;
            }
        }
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) === "member_") continue;
            array_push($SQL,"`$key` = '$value'");
        }
        $SQL = join(" , ",$SQL);
        mysqli_query($db, "UPDATE `project` SET $SQL WHERE `id` = $id");
        
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,7) !== "member_") continue;
            array_push($SQL,"(".join(",",array($id,$value)).")");
        }
        $SQL = join(",",$SQL);
        mysqli_query($db, "DELETE FROM `member` WHERE `project_id` = $id");
        mysqli_query($db, "INSERT INTO `member`(`project_id`,`user_id`) VALUES $SQL");
        echo "修改成功";
    }
    
    out:
    // 顯示
    $project = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `project` WHERE id = $id"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案修改</title>
</head>

<body>
<form id="form" action="" method="POST">
        <span>name：</span><input required type="text" name="name" value='<?php echo $project["name"];?>'><br><br>
        <span>detail：</span><input required type="text" name="detail" value='<?php echo $project["detail"];?>'><br><br>
        <table border="1" width="600" cellpadding="5" align="center">
            <tr>
                <td width="10%">Leader：</td>
                <td>
                    <?php
                        $arr = mysqli_query($db, "SELECT * FROM `user`");
                        while ($row = mysqli_fetch_array($arr)){
                            $checked = ($project["leader"] === $row["id"]? "checked": "");
                            echo "<input required $checked type='radio' name='leader' value='$row[id]' id='leader_$row[id]'>
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
                            $checked = (mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `member` WHERE `project_id` = $id And `user_id` = $row[id]"))? "checked": "");
                            echo "<input type='checkbox' $checked name='member_$row[id]' value='$row[id]' id='member_$row[id]'>
                                <label for='member_$row[id]'>$row[name]</label> ";
                        }
                    ?>
                </td>
            </tr>
        </table>
        <input type="submit">
    </form>
    <button onclick="location.href='index.php'">返回</button>
</body>

</html>