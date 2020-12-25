<?php
    include '../connect.php';
    if (empty($_SESSION['user'])) header("Location:../index.php");
    $user = json_decode($_SESSION['user']);
    $id = $user->id;
    $arr = mysqli_query($db, "SELECT * FROM `project` WHERE `leader` = $id or `id` in (SELECT `project_id` FROM `member` WHERE `user_id` = $id)");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案管理</title>
    <style>
        a {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table border="1" width="1000" cellpadding="5" align="center">
        <tr>
            <td width="30%">專案名稱</td>
            <td width="40%">專案說明</td>
            <td>專案組長</td>
            <td>面向</td>
            <td>修改</td>
            <td>刪除</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($arr)){
                $leader = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE id = $row[leader]"))["name"];
                echo "<tr>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$leader</td>";
                echo "<td><a href='Side.php?id=$row[0]'>面向</a></td>";
                echo "<td><a href='Project_edit.php?id=$row[0]'>修改</a></td>";
                echo "<td><a onclick='dele($row[0])'>刪除</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='Project_add.php'">新增</button>
    <button onclick="location.href='../Control.php'">返回</button>
    <script>
        function dele(id) {
            if (confirm('確認刪除?'))
                location.href = `Project_dele.php?id=${id}`;
        }
    </script>
</body>

</html>