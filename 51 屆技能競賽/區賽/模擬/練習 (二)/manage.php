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
    <title>WEB</title>
    <style>
        .locked,
        .lock {
            left: 85%;
        }

        .locked {
            color: gray;
        }

        .lock {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="head">
        <button class="button" onclick="href('login.php')">BACK</button>
        <div class="title">問卷</div>
    </div>
    <div class="information">
        <button class='to' onclick="toggle('.insert')">新增問卷</button>
        <button class='to' onclick="toggle('.manage')">問卷管理</button><br><br>
        <form action="control.php?c=csv_in" method="post" enctype="multipart/form-data">
            <div class="topic">
                <div>CSV:<input type="file" required name="csv" accept=".csv"></div>
            </div>
            <input type="submit" class="button" value="送出">
        </form>

    </div>
    <div class="box">
        <div class="question insert">
            <form action="insertForm.php" method="GET">
                問卷標題 <input type="text" required name="title"><br><br>
                問卷題數 <input type="number" min="1" value="1" required name="number"><br><br>
                <input type="submit" class="button" value="送出">
            </form>
        </div>
        <?php
            $form = DB::query("SELECT * FROM form WHERE user = {$_SESSION['user']->id}");
            foreach ($form as $key => $val) {
                $count = DB::query("SELECT COUNT(DISTINCT `sort`) as count FROM response WHERE invite = '$val->invite'")[0]->count;
                echo "<div class='question manage' hidden>";
                echo "<h2>$val->name</h2>";
                echo "<div class='required'>份數 x $count</div>";
                if ($val->isLocking) 
                    echo "<div class='required locked'>已鎖定</div>";
                else 
                    echo "<div class='required lock' onclick='lock(`$val->invite`)'>鎖定</div>";
                echo "<button onclick='href(`detail.php?invite=$val->invite`)'>詳細資訊</button>";
                echo "<button onclick='href(`picture.php?invite=$val->invite`)'>圖表統計</button>";
                echo "<button onclick='href(`editForm.php?invite=$val->invite`)'>修改</button>";
                echo "<button onclick='href(`dele.php?invite=$val->invite`)'>刪除</button>";
                echo "<button onclick='copy(`$val->invite`)'>複製(問題)</button>";
                echo "<button onclick='copy(`$val->invite`,1)'>複製(問題 & 回答)</button>";
                echo "<button onclick='out(`$val->invite`)'>輸出csv</button>";
                echo "</div>";
            }
        ?>
    </div>
    <script>
        function out(invite) {
            href(`control.php?c=csv_out&invite=${invite}`);
        }
        function toggle(sql) {
            $('.question').hide();
            $(sql).show();
        }
        function copy(invite, type = 0) {
            let new_invite = prompt('請輸入新的問卷邀請碼').trim();
            if (new_invite === '' || Number(par(DB('query', `SELECT COUNT(*) FROM FORM WHERE invite Like '${new_invite}'`))[0][0]))
                exit('邀請碼錯誤')
            $.post(`control.php?c=copy&invite=${invite}&type=${type}&new_invite=${new_invite}`);
            alert('複製完成');
            history.go(0);
        }
        function lock(invite) {
            DB('work', `UPDATE form SET isLocking=1 WHERE invite LIKE '${invite}'`);
            alert('鎖定成功');
            history.go(0);
        }
        toggle('.manage');
    </script>
</body>

</html>