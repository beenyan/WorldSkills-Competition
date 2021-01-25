<?php
include "connect.php";
if (!empty($_POST)) {
    $upadte = [];
    foreach ($_POST as $key => $value) {
        array_push($upadte, "`$key`" . " = '$value'");
    }
    $upadte = join(", ", $upadte);
    // echo "UPDATE `leader` SET $upadte WHERE `id` = $_SESSION[leader_id]";
    mysqli_query($db, "UPDATE `leader` SET $upadte WHERE `id` = $_SESSION[leader_id]");
    echo "修改成功";
}
$view = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `leader` WHERE id = $_SESSION[leader_id]"))["name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評分指標修改</title>
</head>
<body align="center">
    <form action="" method="post">
        Name：<input type="text" name="name" value='<?php echo $view; ?>'>
        <input type="submit">
    </form>
    <button onclick="location.href='leader_view.php'">Back</button>
</body>
</html>