<?php
    include '../connect.php';
    $index = (empty($_GET["index"])? 0: $_GET["index"]);
    $sort = array("ASC","DESC")[$index];
    $arr = mysqli_query($db, "SELECT * FROM `User` ORDER BY `account` $sort");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者管理</title>
    <style>
        a {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <table border="1" cellpadding="5" align="center">
        <tr>
            <td>使用者名稱</td>
            <td><a href="?index=<?php echo $index^1;?>">使用者帳號</a></td>
            <td>使用者密碼</td>
            <td>使用者修改</td>
            <td>使用者刪除</td>
        </tr>
        <?php
            $value = 4;
            while ($row = mysqli_fetch_array($arr)){
                echo "<tr>";
                for ($i = 1; $i <= 3; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                if ($row['rank'] > 1){
                    echo "<td><a href='User_edit.php?id=$row[id]'>修改</a></td>";
                    echo "<td><a onclick='dele($row[id])'>刪除</a></td>";
                }
                echo ($row['rank'] == 1?"<td></td><td></td>": "")."</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='User_add.php'">新增</button>
    <button onclick="location.href='../Control.php'">返回</button>
    <script>
        function dele(id) {
            if (confirm('確認刪除?'))
                location.href = `User_dele.php?id=${id}`;
        }
    </script>
</body>

</html>