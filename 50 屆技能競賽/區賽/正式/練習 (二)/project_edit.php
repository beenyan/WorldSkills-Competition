<?php
include "connect.php";
if (!empty($_POST)) {
    $upadte = [];
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 5) !== "user_") {
            array_push($upadte, "`$key`" . " = '$value'");
        }
    }
    $upadte = join(", ", $upadte);
    // echo "UPDATE `project` SET $upadte WHERE `id` = $_SESSION[project_id]";
    mysqli_query($db, "UPDATE `project` SET $upadte WHERE `id` = $_SESSION[project_id]"); // 修改專案

    mysqli_query($db, "DELETE FROM `member` WHERE `project_id` = $_SESSION[project_id]"); // 刪除成員，之後一次新增
    $members = [];
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 5) === "user_" && $value !== $_POST["leader"]) {
            array_push($members, "($_SESSION[project_id], $value)");
        }
    }
    $members = join(",", $members);
    // echo "INSERT INTO member (project_id,user_id) VALUES $members";
    mysqli_query($db, "INSERT INTO member (project_id,user_id) VALUES $members");
    echo "修改成功";
}
$project = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM project WHERE id = $_SESSION[project_id]"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者修改</title>
</head>
<body align="center">
    <form action="" method="post">
        Name：<input type="text" required name="name" value="<?php echo $project['name']; ?>"><br><br>
        Detail：<input type="text" required name="detail" value="<?php echo $project['detail']; ?>"><br><br>
        Leader：
        <select name="leader"'>
        <?php
$user_list = mysqli_query($db, "SELECT * FROM user");
while ($row = mysqli_fetch_array($user_list)) {
    $selected = $row["id"] === $project["leader"] ? "selected" : "";
    echo "<option $selected value='$row[id]'>$row[name]</option>";
}
?>
        </select><br><br>
        Members：<br><br>
        <?php
$user_list = mysqli_query($db, "SELECT * FROM user");
while ($row = mysqli_fetch_array($user_list)) {
    $selected = mysqli_fetch_array(mysqli_query($db, "SELECT count(*) as find FROM member WHERE project_id = $project[id] AND user_id = $row[0]"))["find"] ? "checked" : "";
    echo "<input type='checkbox' $selected name='user_$row[id]' value='$row[id]' id='user_$row[id]'><label for='user_$row[id]'>$row[name]</label> ";
}
?><br><br>
        <input type="submit">
    </form>
    <button><a href="project.php">Back</a></button>
</body>
</html>
