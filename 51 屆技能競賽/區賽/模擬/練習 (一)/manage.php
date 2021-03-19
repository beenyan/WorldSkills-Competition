<?php
    include 'connect.php';
    $user = $_SESSION['user'];
    $form = mysqli_query($db,"SELECT * FROM `form` WHERE `user` = $user[id]");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <script src='function.js'></script>
    <link rel="stylesheet" href="Main.css">
    <title>管理介面</title>
</head>

<body>
    <div class="head">
        <div class="title" id="title">新增問卷</div>
        <button class="button" onclick="location.href='login.php'">Back</button>
    </div>
    <div class="box">
        <div class="question" id="add">
            <form action="addForm.php" method="GET">
                <span>問卷名稱：</span><input type="text" required name="title"><br><br>
                <span>問卷題數：</span><input type="number" min="1" value="1" required name="count"><br><br>
                <input type="submit" class="button" value="送出">
            </form>
        </div>
        <?php
            while ($rows = mysqli_fetch_array($form)) {
                $lock = $rows['isLocking']? '已鎖定': '鎖定';
                $edit = $rows['isLocking']?'':"<button onclick=\"location.href='editForm.php?invite=$rows[0]'\">修改</button>";
                echo "
                <div class='question edit' hidden>
                    <div class='required' onclick='lock(\"$rows[0]\")'>$lock</div>
                    <h2 style='margin-bottom:0'>$rows[1]</h2>
                    <h4 style='margin-top:10px'>$rows[0]</h4>
                    $edit
                </div>";
                echo "
                <div class='question manage' hidden>
                    <h2 style='margin-bottom:0'>$rows[1]</h2>
                    <h4 style='margin-top:10px'>$rows[0]</h4>
                    <button onclick='l(\"picture.php?invite=$rows[0]\")'>圖表統計</button>
                    <div class='required'>$rows[count]</div>
                </div>";
            }
        ?>

    </div>
    <div class="information" style='width:200px'>
        <button onclick="toggle('新增問卷','#add')">新增問卷</button>
        <button onclick="toggle('修改問卷','.edit')">修改問卷</button>
        <button onclick="toggle('問卷管理','.manage')">問卷管理</button>
    </div>
    <script>
        function lock(invite) {
            $.post('control.php?c=work', {
                sql: `UPDATE form SET isLocking = 1 WHERE invite LIKE '${invite}'`
            })
            history.go(0);
        }
        function toggle(text = '', sql) {
            $('#title').text(text);
            $('.question').hide();
            $(sql).show();
        }
    </script>
</body>

</html>