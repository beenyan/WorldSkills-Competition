<?php
    session_start();
    $user = json_encode($_SESSION['user']);
    echo "<script>let user = $user;</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <link rel="stylesheet" href="Main.css">
    <title>新增問卷</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="location.href='manage.php'">Back</button>
        <div class="title">
            <?php echo $_GET['title']; ?>
        </div>
    </div>
    <div class="information">
        <input type="hidden" name="name" value="<?php echo $_GET['title']; ?>">
        <div>
            <span>問卷邀請碼</span>
            <input type="text" name="invite" maxlength="16" placeholder='問卷邀請碼'>
        </div>
        <div>
            <span>分頁題數</span>
            <input type="number" name="page" min="5" value="5" placeholder='分頁題數'>
        </div>
        <div>
            <span>所需份數</span>
            <input type="number" name="need" min="1" value="1" placeholder='所需份數'>
        </div>
        <button onclick="sent()">送出</button>
    </div>
    <div class='box'>
        <?php 
            for ($i = 1; $i <= $_GET['count']; ++$i){
                echo "
                <div class='question'>
                    <button onclick='summon(this,1)'>是非</button>
                    <button onclick='summon(this,2)'>單選</button>
                    <button onclick='summon(this,3)'>多選</button>
                    <button onclick='summon(this,4)'>填空</button>
                </div>
                ";
            }
        ?>
    </div>
    <script>
        'use strict';
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
        function move(self, dir) {
            let box = $(self).parent();
            const sort = $('.question');
            const index = sort.index(box);
            if (sort.length === 1 || index === 0 && dir === -1 || index === sort.length - 1 && dir === 1) return;
            if (dir === -1)
                sort[index + dir].before(box[0]);
            else if (dir === 1)
                sort[index + dir].after(box[0]);
        }
        function back(self) {
            $(self).parent().html("<button onclick='summon(this,1)'>是非</button><button onclick='summon(this,2)'>單選</button><button onclick='summon(this,3)'>多選</button><button onclick='summon(this,4)'>填空</button>")
        }
        function summon(self, type) {
            let box = $(self).parent();
            const time = +new Date();
            let html = `<div class='required'><input type='checkbox' name='required' id='${time}'><label for='${time}'>必填</label></div><div class='back' onclick='back(this)'>+</div><div class='up' onclick='move(this,-1)'>↑</div><div class='down' onclick='move(this,1)'>↓</div>`;
            if (type === 1) {
                html += "<input type='hidden' name='type' value = '1'><h2>是非題</h2><div class='topic'><div>問卷說明</div><input name='title' required type='text'></div>";
            } else if (type === 2) {
                html += "<input type='hidden' name='type' value = '2'><h2>單選題</h2><div class='topic'><div>問卷說明</div><input name='title' required type='text'></div><div class='topic'><div>1</div><input name='ques1' type='text'></div><div class='topic'><div>2</div><input name='ques2' type='text'></div><div class='topic'><div>3</div><input name='ques3' type='text'></div><div class='topic'><div>4</div><input name='ques4' type='text'></div><div class='topic'><div>5</div><input name='ques5' type='text'></div><div class='topic'><div>6</div><input name='ques6' type='text'></div>";
            } else if (type === 3) {
                html += `<input type='hidden' name='type' value = '3'><h2>多選題</h2><div class='topic'><div>問卷說明</div><input name='title' required type='text'></div><div class='topic'><div>1</div><input name='ques1' type='text'></div><div class='topic'><div>2</div><input name='ques2' type='text'></div><div class='topic'><div>3</div><input name='ques3' type='text'></div><div class='topic'><div>4</div><input name='ques4' type='text'></div><div class='topic'><div>5</div><input name='ques5' type='text'></div><div class='topic'><div>6</div><input name='ques6' type='text'></div><div class='topic'><div>7</div><input name='ques7' type='text'></div><input type='checkbox' name='another' id='ano${time}'><label for='ano${time}'>其他</label>`;
            } else if (type === 4) {
                html += "<input type='hidden' name='type' value = '4'><h2>填空題</h2><div class='topic'><div>問卷說明</div><input name='title' required type='text'></div>";
            }
            box.html(html);
        }
        function sent() {
            let inf = HTO('.information input');
            if (inf.invite.trim() === '') {
                alert('邀請碼無效');
                return;
            }
            let Ret = false;
            $.post({
                url: 'control.php?c=1',
                async: false,
                data: inf,
                success: e => {
                    e = JSON.parse(e);
                    if (e.status === 403) {
                        alert(e.statusText);
                        Ret = true;
                    }
                },
                error: (e => {
                    alert(e.statusText);
                    Ret = true;
                })
            });
            if (Ret) return;
            if ($('.question').length !== $('.question:has(h2)').length) {
                alert('種類未選擇完整');
                return;
            }
            $('.question input[required]').each(function () {
                if (Ret) return;
                else if (this.value.trim() === '') {
                    alert('表單未填寫完整');
                    Ret = true;
                    return;
                }
            })
            $.post('control.php?c=insert', { // 新增表單
                async: false,
                sql: `INSERT INTO form(invite, name, page, need, user) VALUES ('${inf.invite}','${inf.name}','${inf.page}','${inf.need}','${user.id}')`
            }).fail(e => { alert(e.statusText); Ret = true; });
            if (Ret) return;
            for (let i = 0; i < $('.question').length; ++i) {
                let obj = HTO(`.question:eq(${i}) input`);
                obj.invite = inf.invite;
                $.post('control.php?c=insert', {
                    sql: `INSERT INTO question(${Object.keys(obj).join(",")}) VALUES('${Object.values(obj).join("','")}')`
                })
            }
            alert('問卷新增完成');
        }
    </script>
</body>

</html>