<?php
include "connect.php";
if ($_SESSION["user"]["isAdmin"]) {
    // 管理者
    $arr = mysqli_query($db, "SELECT p.*,u.name as '3' FROM project as p,user as u WHERE u.id = p.leader");
} else {
    // 一般成員
    $arr = mysqli_query($db, "SELECT p.*,u.name as '3' FROM project as p,user as u WHERE (p.leader = {$_SESSION['user']['id']} OR p.id in (SELECT m.project_id FROM member as m WHERE m.user_id = {$_SESSION['user']['id']})) AND u.id = p.leader");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案管理</title>
</head>

<body align="center">
    <table border="1" align="center" width="800">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Detail</td>
            <td>Leader</td>
            <td>Side</td>
            <td>Action</td>
            <td>View</td>
        </tr>
        <?php
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 0; $i <= 3; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "<td><a href='side.php?project_id=$row[0]'>Side</a></td>";
    echo "<td><a href='project_edit.php?project_id=$row[0]'>Edit</a> / <a onclick='Dele($row[0])' href='#'>Dele</a></td>";
    if ($row['view']) {
        echo "<td><a href='project_view.php?project_id=$row[0]'>View</a></td>";
    }
    echo "</tr>";
}
?>
    </table>
    <button onclick="location.href='project_add.php'">Add Project</button>
    <button onclick="location.href='lobby.php'">Back</button>
    <script>
        function Dele(ID) {
            if (confirm("確認刪除?")) {
                location.href = `project_dele.php?project_id=${ID}`;
            }
        }
    </script>
</body>

</html>