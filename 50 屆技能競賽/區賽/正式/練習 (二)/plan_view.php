<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案檢視</title>
</head>
<body align="center">
<table border="1" align="center" width="800">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Detail</td>
        <td>Mode</td>
        <td>Comment</td>
        <td>Action</td>
    </tr>
    <?php
$arr = mysqli_query($db, "SELECT * FROM `plan` WHERE project_id = $_SESSION[project_id]");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>";
    if ($row['mode'] < 2) {
        $text = $row['mode'] ? '關閉評分' : '開起評分';
        echo "<td><button onclick=\"location.href='set.php?send=plan&plan_id=$row[0]'\">$text</button></td>";
    } else {
        echo "<td>已結束評分</td>";
    }

    echo "<td><a href='plan_comment_edit.php?plan_id=$row[0]'>Edit / Add Comment</a></td>";
    echo "<td><a href='plan_edit.php?plan_id=$row[0]'>Edit</a> / <a href='plan_dele.php?plan_id=$row[0]'>Dele</a></td>";
    echo "</tr>";
}
?>
</table>
<button onclick="location.href='leader.php'">Back</button>
</body>
</html>
