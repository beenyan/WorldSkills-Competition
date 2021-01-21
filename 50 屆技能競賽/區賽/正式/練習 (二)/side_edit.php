<?php
include "connect.php";
if (!empty($_POST)) {
    $upadte = [];
    foreach ($_POST as $key => $value) {
        array_push($upadte, "`$key`" . " = '$value'");
    }
    $upadte = join(", ", $upadte);
    // echo "UPDATE `user` SET $upadte WHERE `id` = $_SESSION[user_id]";
    mysqli_query($db, "UPDATE `side` SET $upadte WHERE `id` = $_SESSION[side_id]");
    echo "修改成功";
}
$side = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM side WHERE id = $_SESSION[side_id]"));
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
        Name：<input type="text" name="name" value="<?php echo $side['name']; ?>"><br><br>
        Detail：<input type="text" name="detail" value="<?php echo $side['detail']; ?>"><br><br>
        <input type="submit">
    </form>
    <button><a href="side.php">Back</a></button>
</body>
</html>
