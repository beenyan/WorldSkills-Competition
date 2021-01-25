<?php
include "connect.php";
if (!empty($_POST)) {
    $val = [];
    foreach ($_POST as $key => $value) {
        array_push($val, "($_SESSION[plan_id], $value)");
    }
    $val = join(",", $val);
    // 新增資料庫
    mysqli_query($db, "DELETE FROM `plan_comment` WHERE plan_id = $_SESSION[plan_id]");
    // echo "INSERT INTO plan_comment (plan_id,comment_id) VALUES $val<br>";
    mysqli_query($db, "INSERT INTO plan_comment (plan_id,comment_id) VALUES $val");
    echo "新增成功";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案意見修改/新增</title>
</head>
<body align="center">
    <form action="" method="post">
    <table border="1" align="center" width="800">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Detail</td>

    </tr>
    <?php
$arr = mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $_SESSION[project_id]");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 0; $i <= 2; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "</tr>";
    $comment = mysqli_query($db, "SELECT * FROM `comment` WHERE side_id = $row[0]");
    echo "<tr><td colspan='10'>";
    while ($comment_row = mysqli_fetch_array($comment)) {
        echo "<input type='radio' name='$row[0]' value='$comment_row[0]' id='comment_$comment_row[0]'><label for='comment_$comment_row[0]'>$comment_row[title]</label>";
    }
    echo "</td></tr>";
}
?>
</table>
<input type="submit">
    </form>
<button onclick="location.href='plan_view.php'">Back</button>
</body>
</html>