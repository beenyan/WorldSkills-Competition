<?php
    include 'connect.php';
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
    <title>Home</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="location.href='login.php'">管理員登入</button>
        <div class="title"></div>
    </div>
    <div class="box">
        <div class="question">
            <form action="viewForm.php" method="GET">
                <h1 style="margin-top: 0;">問卷邀請碼</h1>
                <input type="text" required name="invite"><br><br>
                <input type="submit" class="button" value="送出">
            </form>
        </div>
    </div>
</body>

</html>