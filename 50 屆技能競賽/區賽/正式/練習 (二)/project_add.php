<?php
include "connect.php";
if (!empty($_POST)) {
    $filter = array_flip(array_filter(array_keys($_POST), function ($e) {return substr($e, 0, 5) !== "user_";}));
    $name = "(" . join(',', array_keys(array_intersect_key($_POST, $filter))) . ")";
    $val = "(\"" . join('","', array_values(array_intersect_key($_POST, $filter))) . "\")";
    // 新增資料庫
    // echo "INSERT INTO project $name VALUES $val<br>";
    mysqli_query($db, "INSERT INTO project $name VALUES $val");
    $last_id = mysqli_fetch_array(mysqli_query($db, "SELECT `id` FROM `project` ORDER BY `id` DESC LIMIT 1"))["id"];
    $members = [];
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 5) === "user_" && $value !== $_POST["leader"]) {
            array_push($members, "($last_id, $value)");
        }
    }
    $members = join(",", $members);
    // echo "INSERT INTO member (project_id,user_id) VALUES $members";
    mysqli_query($db, "INSERT INTO member (project_id,user_id) VALUES $members");
    echo "新增成功";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案新增</title>
</head>

<body align="center">
    <form action="" method="POST">
        Name：<input type="text" required name="name"><br><br>
        Detail：<input type="text" required name="detail"><br><br>
        Leader：
        <select name="leader">
            <?php
$user_list = mysqli_query($db, "SELECT * FROM user");
while ($row = mysqli_fetch_array($user_list)) {
    echo "<option value='$row[id]'>$row[name]</option>";
}
?>
        </select><br><br>
        Members：<br><br>
        <?php
$user_list = mysqli_query($db, "SELECT * FROM user");
while ($row = mysqli_fetch_array($user_list)) {
    echo "<input type='checkbox' name='user_$row[id]' value='$row[id]' id='user_$row[id]'><label for='user_$row[id]'>$row[name]</label> ";
}
?>
        <br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='project.php'">Back</button>
</body>

</html>