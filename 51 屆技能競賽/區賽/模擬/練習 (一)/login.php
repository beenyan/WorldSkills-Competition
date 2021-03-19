<?php
    include 'connect.php';
    if (isset($_POST['account']) && isset($_POST['password'])){
        $account = $_POST['account'];
        $password = $_POST['password'];
        $user = mysqli_query($db,"SELECT * FROM `user` WHERE `account` LIKE '$account' AND `password` LIKE '$password'");
        if (mysqli_num_rows($user)) {
            $_SESSION['user'] = mysqli_fetch_array($user);
            header('Location:manage.php');
        } else echo '帳號密碼錯誤';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Main.css">
    <title>登入系統</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="location.href='index.php'">Back</button>
    </div>
    <div class="box">
        <div class="question">
            <form action="" method="POST">
                <span>帳號：</span><input type="text" name="account"><br><br>
                <span>密碼：</span><input type="text" name="password"><br><br>
                <input type="submit" class="button" value="登入">
            </form>
        </div>
    </div>
</body>

</html>