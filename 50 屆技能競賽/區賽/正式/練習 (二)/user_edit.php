<?php
include "connect.php";
if (!empty($_POST)) {
    $upadte = [];
    foreach ($_POST as $key => $value) {
        array_push($upadte, "`$key`" . " = '$value'");
    }
    $upadte = join(", ", $upadte);
    // echo "UPDATE `user` SET $upadte WHERE `id` = $_SESSION[user_id]";
    mysqli_query($db, "UPDATE `user` SET $upadte WHERE `id` = $_SESSION[user_id]");
    echo "修改成功";
}
$user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM user WHERE id = $_SESSION[user_id]"));
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
        Name：<input type="text" required name="name" value="<?php echo $user['name']; ?>"><br><br>
        Password：<input type="text" required name="password" value="<?php echo $user['password']; ?>"><br><br>
        <input type="submit">
    </form>
    <button><a href="user.php">Back</a></button>
</body>
</html>
