<?php
    include 'connect.php';
    $form = DB::q('*','form',"invite LIKE '$_GET[invite]'");
    if (!count($form)) href('index.php', '邀請碼無效');
    $form = $form[0];
    $ques = DB::q('*','question',"invite LIKE '$_GET[invite]'",1);
    if (!empty($_POST)) {
        $sort = DB::q('iFNULL(MAX(`sort`),0) as sort','response')[0]->sort;
        foreach ($ques as $key => $val) {
            $type = $val->type;
            $data = [
                'invite' => $_GET['invite'],
                'question_id' => $val->id,
                'sort' => $sort,
            ];
            if ($type == 1) {
                if (!isset($_POST['tf'][$key])) continue;
                $data['data'] = $_POST['tf'][$key];
            } else if ($type == 2) {
                if (!isset($_POST['one'][$key])) continue;
                $data['data'] = $_POST['one'][$key];
            } else if ($type == 3) {
                if (!isset($_POST['much'][$key])) continue;
                $data['data'] = str(array_filter($_POST['much'][$key]));
            } else if ($type == 4) {
                if (!isset($_POST['text'][$key])) continue;
                $data['data'] = $_POST['text'][$key];
            }
        }
        pri($_POST);
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
        <button onclick="href('index.php')">BACK</button>
    </div>
    <div class="block_title"></div>
    <form action="" method="post">
    <table align="center" width='600' border="1">
        <?php
            foreach ($ques as $key => $val) {
                $required = $val->required?'required':'';
                $type = $val->type;
                echo "<tr><td>";
                if ($val->required) echo "<div class='required'>* 必填</div>";
                echo "<h1>$val->title</h1>";
                if ($type == 1) {
                    echo "
                        是<input type='radio' name='tf[$key]' value='1' $required>
                        否<input type='radio' name='tf[$key]' value='0' $required>
                    ";
                } else if ($type == 2) { 
                    foreach (par($val->data) as $data_key => $value) {
                        echo "
                            <input type='radio' name='one[$key]'value='$data_key' $required>$value<br>
                        ";
                    }
                } else if ($type == 3) { 
                    foreach (par($val->data) as $data_key => $value) {
                        echo "
                            <input type='checkbox' name='much[$key][]' value='$data_key'>$value<br>
                        ";
                    }
                    if ($val->another) {
                        echo "
                            其他<input type='text' name='much[$key][]'>
                        ";
                    }
                } else if ($type == 4) { 
                    echo "
                        <textarea $required name='text[$key]'></textarea>
                    ";
                }
                echo "</td></tr>";
            }
        ?>
    </table>
    <input type="submit">
    </form>
    
    <script>
    </script>
</body>

</html>