<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評分檢視</title>
</head>
<body align="center">
    <h2>評分指標</h2>
    <table border="1" align="center" width="800">
        <tr>
            <td>Name</td>
            <td>Action</td>
        </tr>
        <?php
$arr = mysqli_query($db, "SELECT * FROM `leader` as l WHERE project_id = $_SESSION[project_id]");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    echo "<td>$row[name]</td>";
    echo "<td><a href='leader_edit.php?leader_id=$row[0]'>Edit</a> / <a href='leader_dele.php?leader_id=$row[0]'>Dele</a></td>";
    echo "</tr>";
}
?>
    </table>
    <button onclick="location.href='leader.php'">Back</button>
</body>
</html>