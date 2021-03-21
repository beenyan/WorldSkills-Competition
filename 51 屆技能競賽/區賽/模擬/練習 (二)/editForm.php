<?php
    include 'connect.php';
    $form = DB::query("SELECT * FROM `form` WHERE `invite` LIKE '$_GET[invite]'")[0];
    $que = DB::query("SELECT * FROM `question` WHERE `invite` LIKE '$_GET[invite]'");
    out();
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
        <button class="button" onclick="href('manage.php')">BACK</button>
        <div class="title">修改表單</div>
    </div>
    <div class="information">
        <div>
            <span>問卷邀請碼</span>
            <input type="text" name="invite" required maxlength="16" value="<?php echo ($form->invite); ?>"
                placeholder='問卷邀請碼'>
        </div>
        <div>
            <span>分頁題數</span>
            <input type="number" name="page" required min="5" value="<?php echo ($form->page); ?>" placeholder='分頁題數'>
        </div>
        <div>
            <span>所需份數</span>
            <input type="number" name="need" required min="1" value="<?php echo ($form->need); ?>" placeholder='所需份數'>
        </div>
        <button onclick="infedit()">修改</button>
    </div>
    <div class='box'>
        <?php
            foreach ($que as $val) {
                echo "<div class='question'>";
                $checked = $val -> required? 'checked': '';
                echo "
                    <div class='required'>
                        <input type='checkbox' id='required_$val->id' $checked name='required'>
                        <label for='required_$val->id'>必填</label>
                        <input type='hidden' name='type' value='$val->type'>
                        <input type='hidden' name='id' value='$val->id'>
                    </div>";
                if ($val -> type == 1) { // 是非題
                    echo "
                        <h2>是非題</h2>
                        <div class='topic'>
                            <div>問卷說明</div>
                            <input name='title' value='$val->title' required type='text'>
                        </div>";
                } else if ($val -> type == 2) { // 單選題
                    $val->ques = json_decode($val->ques);
                    while (count($val->ques) < 6) array_push($val->ques, '');
                    echo "
                    <h2>單選題</h2>
                    <div class='topic'>
                        <div>問卷說明</div>
                        <input name='title' value='$val->title' required type='text'>
                    </div>";
                    foreach ($val->ques as $key => $value) {
                        $index = $key + 1;
                        echo "
                        <div class='topic'>
                            <div>$index</div><input value='$value' name='ques' type='text'>
                        </div>";
                    }
                } else if ($val -> type == 3) { // 多選題
                    $checked = $val -> another? 'checked': '';
                    $val->ques = json_decode($val->ques);
                    while (count($val->ques) < 7) array_push($val->ques, '');
                    echo "
                    <h2>多選題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' value='$val->title' required type='text'>
                    </div>";
                    foreach ($val->ques as $key => $value) {
                        $index = $key + 1;
                        echo "
                        <div class='topic'>
                            <div>$index</div><input value='$value' name='ques' type='text'>
                        </div>";
                    }
                    echo "<input type='checkbox' $checked name='another'>其他";
                } else if ($val -> type == 4) { // 填空題
                    echo "
                    <h2>填空題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' value='$val->title' required type='text'>
                    </div>";
                }
                echo "<button onclick='questedit(this)'>修改</button>";
                echo "</div>";
            }
        ?>
    </div>
    <script>
        function questedit(self) {
            let obj = HTO($(self).parent().find('input[name!=ques]'));
            if (obj.type == 2 || obj.type == 3) {
                obj.ques = str(HTA($(self).parent().find('input[name=ques]')));
                if (obj.ques === '[]') exit('資料未填寫完整');
                DB('work', `UPDATE question SET ${join(obj)} WHERE id LIKE '${obj.id}'`);
                alert('修改完成');
            } else {
                console.log(obj);
            }
        }
        function infedit() {
            let obj = HTO('.information *');
            DB('work', `UPDATE form SET ${join(obj)} WHERE invite LIKE '${Get.invite}'`);
            location.href = `?invite=${obj.invite}`;
        }
    </script>
</body>

</html>