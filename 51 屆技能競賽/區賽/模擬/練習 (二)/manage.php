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
</head>

<body>
    <div class="head">
        <button class="button" onclick="href('login.php')">BACK</button>
        <div class="title">問卷</div>
    </div>
    <div class="information">
        <button class='to' onclick="toggle('.insert')">新增問卷</button>
        <button class='to' onclick="toggle('.manage')">問卷管理</button>
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
                echo "<button onclick='href(`detail.php?invite=$val->invite`)'>詳細資訊</button>";
                echo "<button onclick='href(`picture.php?invite=$val->invite`)'>圖表統計</button>";
                echo "<button onclick='href(`editForm.php?invite=$val->invite`)'>修改</button>";
                echo "<button onclick='href(`dele.php?invite=$val->invite`)'>刪除</button>";
                echo "<button onclick='copy(`$val->invite`)'>複製(問題)</button>";
                echo "<button onclick='copy(`$val->invite`,1)'>複製(問題 & 回答)</button>";
                echo "</div>";
            }
        ?>
    </div>
    <script>
        function toggle(sql) {
            $('.question').hide();
            $(sql).show();
        }
        $(".to:last").click();
        function copy(invite,type = 0) {
            let new_invite = prompt('請輸入新的問卷邀請碼').trim();
            if (new_invite === '' || Number(par(DB('query',`SELECT COUNT(*) FROM FORM WHERE invite Like '${new_invite}'`))[0][0])) 
                exit('邀請碼錯誤')
            $.post(`control.php?c=copy&invite=${invite}&type=${type}&new_invite=${new_invite}`);
            console.log(`control.php?c=copy&invite=${invite}&type=${type}&new_invite=${new_invite}`);
            alert('複製完成');
        }
    </script>
</body>

</html>