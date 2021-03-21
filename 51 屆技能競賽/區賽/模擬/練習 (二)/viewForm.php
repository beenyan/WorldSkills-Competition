<?php
    include 'connect.php';
    $form = DB::query("SELECT * FROM form WHERE invite = '$_GET[invite]'");
    if (!count($form)){
        $_SESSION['message'] = '邀請碼無效';
        href('index.php');
    }
    $form = $form[0];
    $count = DB::query("SELECT COUNT(DISTINCT `sort`) as count FROM response WHERE invite = '$_GET[invite]'")[0]->count;
    if ($count >= $form->need) {
        $_SESSION['message'] = '問卷已收集完畢';
        href('index.php');
    }
    $que = DB::query("SELECT * FROM question WHERE invite = '$_GET[invite]'");
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
        <button class="button" onclick="href('index.php')">BACK</button>
        <div class="title">
            <div id="complete">0%</div>
            <?php echo $form->name; ?>
        </div>
    </div>
    <div class="information">
        <button onclick="sent()">送出</button>
    </div>
    <div class="box">
        <?php
            foreach ($que as $key => $val) {
                $page = floor($key / $form->page + 1);
                $hidden = $page == 1? '': 'hidden';
                echo "<div class='question page_$page' $hidden>";
                echo "<input type='hidden' name='question_id' value='$val->id'>";
                echo "<h2>$val->title</h2>";
                if ($val->required) echo "<div class='required red'>必填</div>";
                if ($val->type == 1) {
                    echo "
                        <div class='anser'>
                            <input type='radio' value='1' set='data' name='$key'>是
                        </div>
                        <div class='anser'>
                            <input type='radio' value='0' set='data' name='$key'>否
                        </div>";
                } else if ($val->type == 2) {
                    $data = json_decode($val->ques);
                    foreach ($data as $data_key => $data_val) {
                        echo "
                        <div class='anser'>
                            <input type='radio' value='$data_key' set='data' name='$key'>$data_val
                        </div>
                        <br><br>";
                    }
                } else if ($val->type == 3) {
                    $data = json_decode($val->ques);
                    foreach ($data as $data_key => $data_val) {
                        echo "
                        <div class='anser'>
                            <input type='checkbox' value='$data_key' name='$key'>$data_val
                        </div>
                        <br><br>";
                    }
                } else if ($val->type == 4) {
                    echo "<textarea name='data' class='anser'></textarea>";
                }
                echo "</div>";
            }
        ?>
    </div>
    <div class='foot'>
        <?php
            for ($index = 1; $index <= ceil(count($que) / $form->page); ++$index){
                $selected = $index - 1? '': 'selected';
                $complete = ($index - 1) * 100 / count($que) * $form->page.'%';
                echo "<div onclick='switchPage(this,`.page_$index`,`$complete`)' class='$selected'>$index</div>";
            }
        ?>
    </div>
    <script>
        function sent() {
            $('.question:has(.required)').each(function (e) {
                if ($(this).find(':checked').length || $(this).find('textarea').length && $(this).find('textarea').val().trim()) return;
                exit('資料填寫不完整');
            })
            const index = par(DB('query', 'SELECT IFNULL(MAX(`sort`),0) + 1 as `index` FROM `response`'))[0][0];
            $('.question').each(function () {
                let data = HTO($(this).find('*:not(:checkbox)'));
                if ($(this).find(':checkbox:checked').length)
                    data.data = JSON.stringify(HTA($(this).find(':checkbox:checked')));
                if (!data.hasOwnProperty('data')) return;
                data.sort = index;
                data.invite = Get.invite;
                insert('response', data);
            })
            alert('問卷填寫完畢');
            history.go(-1);
        }
        function switchPage(self, sql, text) {
            $("#complete").text(text);
            $('.foot div').removeClass('selected');
            $(self).addClass('selected');
            $('.question:not(:hidden)').hide();
            $(sql).show();
        }
    </script>
</body>

</html>