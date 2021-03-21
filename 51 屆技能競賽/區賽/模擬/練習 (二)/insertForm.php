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
        .question:first-of-type .up,
        .question:last-of-type .down {
            display: none;
        }
    </style>
</head>

<body>
    <div class="head">
        <button class="button" onclick="href('manage.php')">BACK</button>
        <div class="title">
            <?php echo $_GET['title'] ?>
        </div>
    </div>
    <div class="information">
        <input type="hidden" name="name" value="<?php echo $_GET['title']; ?>">
        <input type="hidden" name="user" value="<?php echo $_SESSION['user']->id; ?>">
        <div>
            <span>問卷邀請碼</span>
            <input type="text" name="invite" required maxlength="16" placeholder='問卷邀請碼'>
        </div>
        <div>
            <span>分頁題數</span>
            <input type="number" name="page" required min="5" value="5" placeholder='分頁題數'>
        </div>
        <div>
            <span>所需份數</span>
            <input type="number" name="need" required min="1" value="1" placeholder='所需份數'>
        </div>
        <button onclick="sent()">新增問卷</button>
    </div>
    <div class="box">
        <?php 
            for ($i = 1; $i <= $_GET['number']; ++$i){
                echo "
                <div class='question'>
                    <button onclick='summon(this,1)'>是非</button>
                    <button onclick='summon(this,2)'>單選</button>
                    <button onclick='summon(this,3)'>多選</button>
                    <button onclick='summon(this,4)'>填空</button>
                </div>";
            }
        ?>
    </div>
    <script>
        function sent() {
            if ($('.question:not(:has(.required))').length)
                exit('種類未選擇完整');
            let inf = HTO('.information input');
            let sql = { sql: `SELECT COUNT(*) FROM FORM WHERE invite Like '${inf.invite}'` };
            if (Number(JSON.parse(DB('query', sql))[0][0])) exit('邀請碼重複');
            let data = [];
            $('.question').each(function (e) {
                let obj = HTO($(this).find('input[name!=ques]'));
                obj.invite = inf.invite;
                if (obj.type == 2 || obj.type == 3) {
                    obj.ques = str(HTA($(this).find('input[name=ques]')));
                    if (obj.ques === '[]') exit('資料未填寫完整');
                }
                data.push(obj);
            })
            insert('form', inf, false);
            data.forEach(e => insert('question', e));
            alert('新增完成');
        }
        function back(self) {
            $(self).parent().html(`
                <button onclick='summon(this,1)'>是非</button>
                <button onclick='summon(this,2)'>單選</button>
                <button onclick='summon(this,3)'>多選</button>
                <button onclick='summon(this,4)'>填空</button>`);
        }
        function summon(self, type) {
            let box = $(self).parent();
            const time = +new Date();
            let html = `<div class='required'><input type='checkbox' name='required' id='${time}'><label for='${time}'>必填</label></div>
                <div class='back' onclick='back(this)'>+</div>
                <div class='up' onclick='move(this,-1)'>↑</div>
                <div class='down' onclick='move(this,1)'>↓</div>`;
            if (type === 1) {
                html += `<input type='hidden' name='type' value='1'>
                <h2>是非題</h2>
                <div class='topic'>
                    <div>問卷說明</div><input name='title' required type='text'>
                </div>`;
            } else if (type === 2) {
                html += `<input type='hidden' name='type' value='2'>
                    <h2>單選題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' required type='text'>
                    </div>
                    <div class='topic'>
                        <div>1</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>2</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>3</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>4</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>5</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>6</div><input name='ques' type='text'>
                    </div>`;
            } else if (type === 3) {
                html += `<input type='hidden' name='type' value='3'>
                    <h2>多選題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' required type='text'>
                    </div>
                    <div class='topic'>
                        <div>1</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>2</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>3</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>4</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>5</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>6</div><input name='ques' type='text'>
                    </div>
                    <div class='topic'>
                        <div>7</div><input name='ques' type='text'>
                    </div><input type='checkbox' name='another' id='ano${time}'><label for='ano${time}'>其他</label>`;
            } else if (type === 4) {
                html += `<input type='hidden' name='type' value='4'>
                    <h2>填空題</h2>
                    <div class='topic'>
                        <div>問卷說明</div><input name='title' required type='text'>
                    </div>`;
            }
            box.html(html);
        }
        function move(self, dir) {
            let box = $(self).parent();
            const sort = $('.question');
            const index = sort.index(box);
            if (dir === -1)
                sort[index + dir].before(box[0]);
            else if (dir === 1)
                sort[index + dir].after(box[0]);
        }
    </script>
</body>

</html>