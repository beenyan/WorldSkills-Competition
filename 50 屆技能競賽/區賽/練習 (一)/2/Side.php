<?php
    include '../connect.php';
    $id = $_GET['id'];
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
    <table border="1" width="1000" cellpadding="5" align="center">
        <tr>
            <td width="20%">面向名稱</td>
            <td width="60%">面向說明</td>
            <td>修改</td>
            <td>刪除</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($arr)){
                echo "<tr>";
                for ($i = 1; $i <= 2; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                echo "<td><a href='Side_edit.php?id=$id&side=$row[0]'>修改</a></td>";
                echo "<td><a href='Side_dele.php?id=$id&side=$row[0]'>刪除</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
<button onclick="location.href='Side_add.php?id=<?php echo $id;?>'">新增</button>
<button onclick="location.href='index.php'">返回</button>
</body>
</html>