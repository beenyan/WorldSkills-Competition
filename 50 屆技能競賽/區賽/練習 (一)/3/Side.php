<?php
    include '../connect.php';
    $id = $_SESSION["project"];
    $leader = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `project` WHERE id = $id"))["leader"];
    $arr = mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>面向</title>
</head>
<body>
    <table border="1" width="600" cellpadding="5" align="center">
        <tr>
            <td width="20%">面向名稱</td>
            <td width="40%">面向說明</td>
            <td>意見</td>
            <td>修改</td>
            <td>刪除</td>
            <td>發表意見</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($arr)){
                $checked = ($row['increase']? "checked": "");
                echo "<tr>";
                for ($i = 1; $i <= 2; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                echo "<td><a href='../set.php?side=$row[0]&url=4/index.php'>意見</a></td>";
                echo "<td><a href='../set.php?side=$row[0]&url=3/Side_edit.php'>修改</a></td>";
                echo "<td><a href='Side_dele.php?id=$id&side=$row[0]'>刪除</a></td>";
                echo "<td>";
                if ($_SESSION['user']['rank'] == 1 || $_SESSION['user']['id'] == $leader){
                    echo "<input onclick=\"location.href='../set.php?side=$row[id]&url=4/Comment_show.php'\" type='checkbox' $checked>";
                }
                else echo "無權限";
                "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='Side_add.php?id=<?php echo $id;?>'">新增</button>
    <button onclick="location.href='index.php'">返回</button>
</body>
</html>