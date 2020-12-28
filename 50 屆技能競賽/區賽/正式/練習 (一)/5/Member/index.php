<?php
    include '../../connect.php';
    $user_id = $_SESSION['user']['id'];
    $arr = mysqli_query($db, "SELECT * FROM `plan` WHERE `project_id` in (SELECT `project_id` FROM `member` WHERE `user_id` = $user_id)");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" cellpadding="5" width="1000" align="center">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Detail</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($arr)){
                echo "<tr>";
                for ($i = 0; $i <= 2; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='../../Control.php'">返回</button>
</body>

</html>