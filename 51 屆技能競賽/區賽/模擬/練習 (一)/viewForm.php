<?php
    include 'connect.php';
    $que = new DB("SELECT * FROM `question` WHERE `invite` LIKE '$_GET[invite]'");
    if ($que->length === 0){
        $_SESSION['message'] = '邀請碼無效';
        header('Location:index.php');
    }
    $form = new DB("SELECT * FROM `form` WHERE `invite` LIKE '$_GET[invite]'");
    if ($form->data->count >= $form->data->need) {
        $_SESSION['message'] = '已達到指定問卷數';
        header('Location:index.php');
    }
    JSget();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <link rel="stylesheet" href="Main.css">
    <title>填寫問卷</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="location.href='index.php'">Back</button>
        <div class="title">
            <?php echo $form->data->name; ?>
            <div id="complete"
                style="font-size: 15px;position: absolute; left: 5px; top: 5px;color: rgb(121, 121, 121);">0%</div>
        </div>
    </div>
    <div class="information">
        <button onclick="sent()">送出</button>
    </div>
    <?php
        $index = 0;
        for ($page = 1; $page < $que->length / $form->data->page + 1; ++$page){
            $hidden = $page - 1? 'hidden': '';
            echo "<div class='box' id='box_$page' $hidden>";
            $start = ($page - 1) * $form->data->page;
            foreach ((new DB("SELECT * FROM `question` WHERE `invite` = '$_GET[invite]' LIMIT $start,{$form->data->page}"))->data as $key => $val) {
                ++$index;
                $key = $val->id.$val->invite;
                echo "<div class='question'>";
                echo "<input type='hidden' name='question_id' value='$val->id'>";
                echo "<div class='no'>$index</div>";
                echo "<h2>$val->title</h2>";
                if ($val -> required) echo "<div class='required red'>* 必填</div>";
                if ($val -> type == 1) { // 是非題
                    echo "
                        <div class='anser'>
                            <input type='radio' value='ques1' name='$key' id='1$key'><label for='1$key'>是</label>
                        </div>
                        <div class='anser'>
                            <input type='radio' value='ques2' name='$key' id='2$key'><label for='2$key'>否</label>
                        </div>
                    ";
                } else if ($val -> type == 2) { // 單選題
                    for ($i = 4; $i <= 9; ++$i) { 
                        if ($val->$i === '') continue;
                        $num = 'ques'.($i - 3);
                        echo "<div class='anser'>
                            <input type='radio' value='$num' name='$key' id='$i$key'><label for='$i$key'>{$val->$i}</label>
                        </div><br><br>";
                    }
                } else if ($val -> type == 3) { // 多選題
                    for ($i = 4; $i <= 9; ++$i) { 
                        if ($val->$i === '') continue;
                        $num = 'ques'.($i - 3);
                        echo "<div class='anser'>
                            <input type='checkbox' name='$num' id='$i$key'><label for='$i$key'>{$val->$i}</label>
                        </div><br><br>";
                    }
                    if ($val->another) {
                        echo "<br>
                            <input type='radio' value='another' name='$key' id='ano$i$key'>
                            <label for='ano$i$key'>其他：</label>
                            <input name='another' type='text'>";
                    }
                } else if ($val -> type == 4) { // 填空題
                    echo "<textarea name='another' class='anser'></textarea>";
                }
                echo "</div>";
            }
            echo "</div>";
        }
    ?>
    <div class='foot'>
        <?php
            $page = 0;
            for ($index = 0; $index < $que->length; $index += $form->data->page){
                $selected = $page? '': 'selected';
                ++$page;
                $complete = ($page - 1) * 100 / $que->length * $form->data->page;
                echo "<div onclick='switchPage(this,$page - 1,$complete)' class='$selected'>$page</div>";
            }
        ?>
    </div>
    <script>
        function HTO(SQL) {
            let ret = {};
            $(SQL).each((index, ele) => {
                const self = $(ele);
                const type = self.attr('type');
                const name = self.attr('name');
                const val = self.val();
                if (val === '' || type === 'radio' && !self.prop('checked') || name === undefined || type === 'text') return;
                if (type === 'radio' && val === 'another') 
                    ret[val] = self.siblings(':text').val();
                else if (type === 'radio')
                    ret[val] = 1;
                else if (type === 'checkbox')
                    ret[name] = Number(self.prop('checked'));
                else
                    ret[name] = val;
            });
            return ret;
        }
        function switchPage(self, showIndex, complete) {
            let index = $('.foot').children('.selected').index();
            if (showIndex === index) return;
            $('.foot div').removeClass('selected');
            $(self).addClass('selected');
            $('.box:visible').fadeOut();
            $(`#box_${++showIndex}`).fadeIn();
            $('#complete').text(complete + "%");
        }
        function sent(params) {
            for (let index = 0; index < $('.question').length; ++index) {
                let sql = `.question:eq(${index}):has(.required) `;
                if (!$(sql).length) continue;
                if ($(`${sql}textarea`).length && $(`${sql}textarea`).val().trim() === '' || !$(`${sql}textarea`).length && !$(`${sql}:checked`).length || $(`${sql}:radio[value='another']:checked`).length && $(`${sql}:text`).val().trim() === '') {
                    alert(`第${index + 1}題未填寫完整。`);
                    return;
                }
            }
            for (let index = 0; index < $('.question').length; ++index) {
                let data = HTO(`.question:eq(${index}) input,.question:eq(${index}) textarea`);
                if (Object.entries(data).length === 1) continue;
                $.post('control.php?c=insert', {
                    sql: `INSERT INTO response(${Object.keys(data).join(",")}) VALUES('${Object.values(data).join("','")}')`
                });
            }
            $.post('control.php?c=work', {
                sql: `UPDATE form SET count = count + 1 WHERE invite LIKE '${Get.invite}'`
            });
            alert('問卷填寫完畢');
            history.go(0);
        }
    </script>
</body>

</html>