<?php
    include 'connect.php';
    $form = (new DB("SELECT * FROM `form` WHERE `invite` LIKE '$_GET[invite]'"))->data;
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
    <title>修改問卷</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="location.href='manage.php'">Back</button>
        <div class="title">
            <?php cout($form->name) ?>
        </div>
    </div>
    <div class="information">
        <input type="hidden" id="invite" value="<?php cout($form->invite); ?>">
        <div>
            <span>問卷邀請碼</span>
            <input type="text" name="invite" maxlength="16" value="<?php cout($form->invite); ?>" placeholder='問卷邀請碼'>
        </div>
        <div>
            <span>分頁題數</span>
            <input type="number" name="page" min="5" value="<?php cout($form->page); ?>" placeholder='分頁題數'>
        </div>
        <div>
            <span>所需份數</span>
            <input type="number" name="need" min="1" value="<?php cout($form->need); ?>" placeholder='所需份數'>
        </div>
        <button onclick="infedit()">修改</button>
    </div>
    <div class='box'>
        <?php
            foreach ((new DB("SELECT * FROM `question` WHERE `invite` = '$_GET[invite]'"))->data as $val) {
                echo "<div class='question'>";
                $checked = $val -> required? 'checked': '';
                echo "
                    <div class='required'>
                        <input type='checkbox' id='required_$val->id' $checked name='required'>
                        <label for='required_$val->id'>必填</label>
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
                    echo "
                        <h2>單選題</h2>
                        <div class='topic'>
                            <div>問卷說明</div>
                            <input name='title' value='$val->title' required  type='text'>
                        </div>
                        <div class='topic'>
                            <div>1</div><input value='$val->ques1' name='ques1' type='text'>
                        </div>
                        <div class='topic'>
                            <div>2</div><input value='$val->ques2' name='ques2' type='text'>
                        </div>
                        <div class='topic'>
                            <div>3</div><input value='$val->ques3' name='ques3' type='text'>
                        </div>
                        <div class='topic'>
                            <div>4</div><input value='$val->ques4' name='ques4' type='text'>
                        </div>
                        <div class='topic'>
                            <div>5</div><input value='$val->ques5' name='ques5' type='text'>
                        </div>
                        <div class='topic'>
                            <div>6</div><input value='$val->ques6' name='ques6' type='text'>
                        </div>";
                } else if ($val -> type == 3) { // 多選題
                    $checked = $val -> another? 'checked': '';
                    echo "
                    <h2>多選題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' value='$val->title' required type='text'>
                    </div>
                    <div class='topic'>
                        <div>1</div><input value='$val->ques1' name='ques1' type='text'>
                    </div>
                    <div class='topic'>
                        <div>2</div><input value='$val->ques2' name='ques2' type='text'>
                    </div>
                    <div class='topic'>
                        <div>3</div><input value='$val->ques3' name='ques3' type='text'>
                    </div>
                    <div class='topic'>
                        <div>4</div><input value='$val->ques4' name='ques4' type='text'>
                    </div>
                    <div class='topic'>
                        <div>5</div><input value='$val->ques5' name='ques5' type='text'>
                    </div>
                    <div class='topic'>
                        <div>6</div><input value='$val->ques6' name='ques6' type='text'>
                    </div>
                    <div class='topic'>
                        <div>7</div><input value='$val->ques7' name='ques7' type='text'>
                    </div>
                    <input type='checkbox' $checked name='another' id='ano{$val->id}'><label for='ano{$val->id}'>其他</label>";
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
        function join(obj, filter = [], a = ',', b = '=\'') {
            return Object.entries(obj).filter(e => !filter.includes(e[0])).map(e => `${e.join(b)}'`).join(a);
        }
        function HTO(SQL) {
            let ret = {};
            $(SQL).each((index, ele) => {
                const self = $(ele);
                const type = self.attr('type');
                const name = self.attr('name');
                const val = self.val();
                if (val === '') return;
                else if (type === 'checkbox')
                    ret[name] = Number(self.prop('checked'));
                else
                    ret[name] = val;
            });
            return ret;
        }
        function questedit(self) {
            let obj = HTO($(self).parent().find('input'));
            $.post('control.php?c=work', {
                sql: `UPDATE question SET ${join(obj, ['id'])} WHERE id = ${obj.id}`
            });
            alert('修改成功');
        }
        function infedit() {
            let inf = HTO('.information input');
            if (inf.invite.trim() === '') {
                alert('邀請碼無效');
                return;
            }
            if (inf.invite)
                inf.sql = `SELECT * FROM form WHERE invite LIKE '${inf.invite}' AND invite NOT LIKE '${Get.invite}'`;
            let Ret = false;
            $.post({
                url: 'control.php?c=2',
                async: false,
                data: inf,
                success: e => {
                    e = JSON.parse(e);
                    if (e.status === 403) {
                        alert(e.statusText);
                        Ret = true;
                        return;
                    }
                },
                error: (e => {
                    alert(e.statusText);
                    Ret = true;
                })
            });
            if (Ret) return;
            $.post('control.php?c=work', {
                sql: `UPDATE form SET invite='${inf.invite}',page='${inf.page}',need='${inf.need}' WHERE invite='${Get.invite}'`
            });
            alert('修改成功');
            Get.invite = inf.invite;
        }
    </script>
</body>

</html>