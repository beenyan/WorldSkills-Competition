<?php
include "connect.php";
if (!$_SESSION["user"]["isAdmin"]) {
    die('
    <body align="center">
        <h1>一般使用者無權管理</h1>
        <button><a href="lobby.php">Back</a></button>
    </body>');
}
$_GET["sort"] = $_GET["sort"] ?? 0;
$sort = $_GET["sort"] ? 'ASC' : 'DESC';
$arr = mysqli_query($db, "SELECT * FROM `user` ORDER BY `account` $sort");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者管理</title>
</head>
<body align="center">
    <table border="1" align="center" width="800">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td><a href='user.php?sort=<?php echo $_GET["sort"] ^ 1; ?>'>Account</a></td>
            <td>Password</td>
            <td>Action</td>
        </tr>
<?php
while ($row = mysqli_fetch_array($arr)) {
    echo "<tr>";
    for ($i = 0; $i <= 3; ++$i) {
        echo "<td>$row[$i]</td>";
    }
    echo "<td><a href='user_edit.php?user_id=$row[0]'>Edit</a> / <a href='user_dele.php?user_id=$row[0]'>Dele</a></td>";
    echo "</tr>";
}
?>
    </table>
    <button><a href="user_add.php">Add User</a></button>
    <button><a href="lobby.php">Back</a></button>
</body>
</html>