<?php
include "connect.php";
$arr = mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $_SESSION[project_id]");
if (!empty($_POST) && mysqli_num_rows($arr) < 10) {
    $name = "(" . join(',', array_keys($_POST)) . ")";
    $val = "(\"" . join('","', array_values($_POST)) . "\")";
    // 新增資料庫
    // echo "INSERT INTO side $name VALUES $val<br>";
    mysqli_query($db, "INSERT INTO side $name VALUES $val");
}
$leader = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `project` WHERE id = $_SESSION[project_id]"))["leader"];
$arr = mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $_SESSION[project_id]");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>面相管理</title>
</head>
<body align="center">
<table border="1" align="center" width="800">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Detail</td>
        <td>Action</td>
        <td>Comment</td>
        <td>發表意見</td>
    </tr>
<?php
while ($row = mysqli_fetch_array($arr)) {
    $checked = $row['increase'] ? "checked" : "";
    echo "<tr>";
    for ($i = 0; $i <= 2; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "<td><a href='side_edit.php?side_id=$row[0]'>Edit</a> / <a href='side_dele.php?side_id=$row[0]'>Dele</a></td>";
    echo "<td><a href='comment.php?side_id=$row[0]'>Comment</a></td>";
    if ($_SESSION['user']['isAdmin'] || $_SESSION['user']['id'] == $leader) {
        echo "<td><input onclick=\"location.href='set.php?send=side&side_id=$row[id]'\" type='checkbox' $checked></td>";
    }
    echo "</tr>";
}
?>
</table>
<?php
if (mysqli_num_rows($arr) < 10) {
    echo "
    <form action='' method='POST'>
    Name：<input type='text' required name='name'><br><br>
    Detail：<input type='text' required name='detail'><br><br>
    <input type='hidden' name='project_id' required value='$_SESSION[project_id]'>
    <input type='submit'>
    </form>";
}
?>
<button onclick="location.href='project.php'">Back</button>
</body>
</html>