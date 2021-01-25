<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .red{
            background-color: red;
        }
    </style>
    <title>檢視執行專案</title>
</head>
<body align="center">
    <table border="1" align="center" width="800">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Detail</td>
            <td>Score</td>
            <td>Action</td>
        </tr>
        <?php
$arr = mysqli_query($db, "SELECT * FROM `plan` WHERE project_id in (SELECT m.project_id FROM member as m WHERE user_id = {$_SESSION['user']['id']})");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 0; $i <= 2; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    if ($row['mode'] % 2) {
        $find = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `plan_score` WHERE plan_id = $row[0] And user_id = {$_SESSION['user']['id']}"));
        if ($find) {
            echo "<td>已評分</td>";
        } else {
            echo "<td class='red'><form action='set.php' method='get'>
            <input type='hidden' name='send' value='plan_score'>
            <input type='hidden' name='plan_id' value='$row[0]'>
            <select name='score'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3' selected>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
            </select>
            <input type='submit'></input>
        </form></td>";
        }
    } else {
        echo '<td>' . ($row['mode'] == 0 ? '尚未開始評分' : '已結束評分') . '</td>';
    }

    echo "</tr>";
}
?>
    </table>
    <button onclick="location.href='lobby.php'">Back</button>
</body>
</html>