<?php
    include 'connect.php';
    $number = $_GET['number'];
    if(!empty($_POST)) {
        exit();
        $form = DB::q('count(*) as total','form',"invite = '$_POST[invite]'")[0];
        if ($form->total && 0) alert('邀請碼重複');
        else {
            DB::insert('form',[
                    'title' => $_POST['form_title'],
                    'invite' => $_POST['invite'],
                    'need' => $_POST['need'],
                    'page' => $_POST['page']
                ]
            );
            foreach ($_POST['type'] as $key => $type) {
                $data = [
                    'invite' => $_POST['invite'],
                    'type' => $type,
                    'title' => $_POST['title'][$key],
                    'required' => isset($_POST['required'][$key])? 1: 0,
                    'another' => isset($_POST['another'][$key])? 1: 0,
                    'data' => isset($_POST['data'][$key])? str(array_filter($_POST['data'][$key])): '[]'
                ];
                DB::insert('question', $data);
            }
            href('manage.php','insert succeed');
        }
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
        <button onclick="href('manage.php')">BACK</button>
    </div>
    <div class="block_title"></div>
    <form method="post">
        問卷標題<input type="text" name='form_title' required><br><br>
        邀請碼<input type="text" name='invite' maxlength="16" required><br><br>
        所需份數<input type="number" name='need' min='1' required><br><br>
        分頁題數<input type="number" name='page' min='1' required><br><br>
        <table align="center" width='600' border="1">
            <?php
                for ($i = 0 ;$i < $number ; ++$i) {
                    echo "
                    <tr><td>
                        <input type='text' required class='hid'>
                        <button onclick=ques(this,1,$i)>是非</button>
                        <button onclick=ques(this,2,$i)>單選</button>
                        <button onclick=ques(this,3,$i)>多選</button>
                        <button onclick=ques(this,4,$i)>填充</button>
                    </td></tr>";
                }
            ?>
        </table>
        <input type="submit">
    </form>
    <script>
        function move(self, dir) {
            let row = $(self).parents('tr:first');
            if (dir == -1) row.insertBefore(row.prev());
            else row.insertAfter(row.next());
        }
        function swit(self, dir) {
            $(self).parent().html(`
                <input type="text" required="" class="hid">
                <button onclick="ques(this,1,0)">是非</button>
                <button onclick="ques(this,2,0)">單選</button>
                <button onclick="ques(this,3,0)">多選</button>
                <button onclick="ques(this,4,0)">填充</button>`);
        }
        function ques(self, type, i) {
            let $parent = $(self).parent();
            let HTML = `
                <input type="checkbox" name='required[${i}]'>必填
                <span class='button' onclick='swit(this)'>換題</span>
                <span class='up button' onclick='move(this,-1)'>上</span>
                <span class='down button' onclick='move(this,1)'>下</span>
            `;
            if (type === 1) {
                HTML += `
                    <input type="hidden" name="type[${i}]" value="${type}">
                    <h1>是非題</h1>
                    標題 <input type="text" name="title[${i}]" required><br>
                `;
            } else if (type === 2) {
                HTML += `
                    <input type="hidden" name="type[${i}]" value="${type}">
                    <h1>單選題</h1>
                    標題 <input type="text" name="title[${i}]" required><br>
                    題目 <input type='text' name='data[${i}][]' required><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                `;
            } else if (type === 3) {
                HTML += `
                    <input type="hidden" name="type[${i}]" value="${type}">
                    <h1>多選題</h1>
                    標題 <input type="text" name="title[${i}]" required><br>
                    題目 <input type='text' name='data[${i}][]' required><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    題目 <input type='text' name='data[${i}][]'><br>
                    <input type="checkbox" name='another[${i}]'>其他
                `;
            } else if (type === 4) {
                HTML += `
                    <input type="hidden" name="type[${i}]" value="${type}">
                    <h1>填充題</h1>
                    標題 <input type="text" name="title[${i}]" required><br>
                `;
            }
            $parent.html(HTML);
        }
    </script>
</body>

</html>