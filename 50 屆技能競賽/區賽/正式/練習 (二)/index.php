<?php
include "connect.php";
if (!empty($_POST)) {
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE account = '$_POST[account]' AND password = '$_POST[password]'"));
    if ($user["id"]) {
        $_SESSION["user"] = $user;
        header("Location:lobby.php");
    } else {
        echo "帳號密碼錯誤";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>登入系統</title>
</head>

<body align="center">
    <form action="" method="post">
        Account：<input type="text" name="account"><br><br>
        Password：<input type="text" name="password"><br><br>
        <input type="submit">
    </form>
</body>

</html>
