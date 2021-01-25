<?php
include "connect.php";
if (!empty($_POST)) {
    $upadte = [];
    foreach ($_POST as $key => $value) {
        array_push($upadte, "`$key`" . " = '$value'");
    }
    $upadte = join(", ", $upadte);
    // echo "UPDATE `plan` SET $upadte WHERE `id` = $_SESSION[plan_id]";
    mysqli_query($db, "UPDATE `plan` SET $upadte WHERE `id` = $_SESSION[plan_id]");
    echo "修改成功";
}
$row = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `plan` WHERE id = $_SESSION[plan_id]"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>專案修改</title>
</head>
<body align="center">
    <form action="" method="post">
        Name：<input type="text" name="name" required value='<?php echo $row['name']; ?>'><br><br>
        Detail：<input type="text" name="detail" required value='<?php echo $row['detail']; ?>'><br><br>
        <input type="submit">
    </form>
    <button onclick="location.href='plan_view.php'">Back</button>
</body>
</html>
