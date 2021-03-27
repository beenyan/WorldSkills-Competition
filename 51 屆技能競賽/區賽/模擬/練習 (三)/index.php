<?php
    include 'connect.php';
    if (isset($_POST['account'])) {
        $data = DB::q('*','user',"account LIKE '$_POST[account]' AND password LIKE '$_POST[password]'");
        if (count($data)) {
            alert('登入成功');
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
    <link rel="stylesheet" href="main.css">
    <title>web</title>
</head>

<body>
    <div class="title">
    </div>
    <div class="block_title"></div>
    <table align="center" border="1">
        <tr>
            <td>
                <form method="POST">
                    帳號 <input type="text" required name="account"><br><br>
                    密碼 <input type="text" required name="password"><br><br>
                    <input type="submit" value="登入">
                </form>
            </td>
            <td>
                <form action="view.php" method="GET">
                    問卷邀請碼<input type="text" required name="invite"><br><br>
                    <input type="submit">
                </form>
            </td>
        </tr>
    </table>

    <script>

    </script>
</body>

</html>