<?php
include "connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案組長管理功能</title>
</head>
<body align="center">
    <table border="1" align="center" width="800">
        <tr>
            <td>Name</td>
            <td>Detail</td>
            <td>View</td>
            <td>Build</td>
            <td>開放檢視</td>
        </tr>
        <?php
$arr = mysqli_query($db, "SELECT p.*,p.detail FROM `project` as p WHERE leader = {$_SESSION['user']['id']}");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 1; $i <= 2; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "<td><a href='leader_view.php?project_id=$row[0]'>評分指標</a> / <a href='plan_view.php?project_id=$row[0]'>執行方案</a></td>";
    echo "<td><a href='leader_add.php?project_id=$row[0]'>評分指標</a> / <a href='plan_add.php?project_id=$row[0]'>執行方案</a></td>";
    if ($row['view']) {
        echo "<td>已開放</td>";
    } else {
        echo "<td><a href='set.php?send=plan_view&project_id=$row[0]'>開放</a></td>";
    }
    echo "</tr>";
}
?>
    </table>
    <button onclick="location.href='plan_add.php'">新增執行方案</button>
    <button onclick="location.href='lobby.php'">Back</button>
</body>
</html>