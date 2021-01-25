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
            <td>Score</td>
        </tr>
        <?php
$arr = mysqli_query($db, "SELECT p.id,p.name,p.detail,AVG(c.score) as score FROM `plan` as p,plan_score as c WHERE `project_id` = $_SESSION[project_id] AND c.plan_id = p.id GROUP BY p.id ORDER BY score DESC");
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 0; $i <= 3; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "</tr>";
}
?>
    </table>
<button onclick="location.href='project.php'">Back</button>
</body>
</html>