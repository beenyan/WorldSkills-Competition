<?php
    include 'connect.php';
    if (isset($_POST['account']) && isset($_POST['password'])){
        $user = DB::query("SELECT * FROM user WHERE account LIKE '$_POST[account]' AND password LIKE '$_POST[password]'");
        if (count($user)) {
            $_SESSION['user'] = $user[0];
            href('manage.php');
        } else alert('登入失敗');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <script src="function.js"></script>
    <link rel="stylesheet" href="Main.css">
    <title>WEB</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="href('index.php')">BACK</button>
        <div class="title">登入</div>
    </div>
    <div class="box">
        <div class="question">
            <form method="post">
                帳號 <input type="text" name="account"> <br><br>
                密碼 <input type="text" name="password"> <br><br>
                <input class='button' type="submit" value='登入'>
            </form>
        </div>
    </div>
</body>

</html>