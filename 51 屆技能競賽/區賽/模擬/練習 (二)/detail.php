<?php
    include 'connect.php';
    $ques = DB::query("SELECT * FROM `question` WHERE `invite` LIKE '$_GET[invite]'");
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
        <div class="title">詳細資料</div>
    </div>
    <div class="box">
        <?php 
            foreach ($ques as $key => $val) {
                echo "<div class='question data'>";
                echo "<p>【問卷】</p>";
                echo "<p>$val->title</p>";
                $res = DB::query("SELECT data FROM response WHERE question_id = $val->id");
                if ($val->type == 1) {
                    $data = [0, 0];
                    foreach ($res as $key => $value)
                        $data[$value->data]++;
                    echo "<p>是x$data[0]</p>";
                    echo "<p>否x$data[1]</p>";
                } else if ($val->type == 2) {
                    $data = par($val->ques);
                    echo "<p>單：".join($data,',')."</p>";
                    foreach ($res as $key => $value) {
                        echo $data[$value->data].' ';
                    }
                } else if ($val->type == 3) {
                    $data = par($val->ques);
                    echo "<p>多：".join($data,',')."</p>";
                    foreach ($res as $key => $value) {
                        $text = join(array_map(function ($i) {return $GLOBALS['data'][$i];},par($value->data)),',');
                        echo "<p>$text</p>";
                    }
                } else if ($val->type == 4) {
                    foreach ($res as $key => $value)
                        echo "<p>$value->data</p>";
                }
                
                echo "</div>";
            }
        ?>
    </div>
</body>

</html>