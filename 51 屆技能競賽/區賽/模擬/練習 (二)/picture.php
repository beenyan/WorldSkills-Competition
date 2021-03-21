<?php
    include 'connect.php';
    $que = DB::query("SELECT * FROM question WHERE invite LIKE '$_GET[invite]' AND type != 4");
    $type = [
        1 => "pie",
        2 => "pie",
        3 => "horizontalBar",
    ];
    $data = [];
    foreach ($que as $key => $val) {
        $ret = [
            "id" => "data_$key",
            "type" => $type[$val->type],
            "title" => $val->title,
            "labels" => $val->type == 1? ['否', '是']: json_decode($val->ques),
            "data" => []
        ];
        if ($val->type == 1) {
            $q = DB::query("SELECT count(`data`) as sum FROM `response` WHERE `question_id` = $val->id GROUP BY `data`");
            foreach ($q as $key => $val)
            array_push($ret['data'],$val->sum);
        } else if ($val->type == 2) {
            $temp = [0,0,0,0,0,0,0,0,0,0];
            $q = DB::query("SELECT (`data`) as 'index' FROM `response` WHERE `question_id` = $val->id");
            foreach ($q as $key => $val)
                $temp[$val->index]++;
            $ret['data'] = array_splice($temp, 0, count($ret['labels']));
        } else if ($val->type == 3) {
            $temp = [0,0,0,0,0,0,0,0,0,0];
            $q = DB::query("SELECT (`data`) as 'd' FROM `response` WHERE `question_id` = $val->id");
            foreach ($q as $key => $val) {
                $js = json_decode($val->d);
                foreach ($js as $key => $value)
                    $temp[$value]++;
            }
            $ret['data'] = array_splice($temp, 0, count($ret['labels']));
        }
        array_push($data, $ret);
    }
    let('data', json_encode($data));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <script src="Include/chart.js"></script>
    <script src="function.js"></script>
    <link rel="stylesheet" href="Main.css">
    <title>WEB</title>
</head>

<body>
    <div class="head">
        <button class="button" onclick="href('manage.php')">BACK</button>
        <div class="title">圖表統計</div>
    </div>
    <div class="box">
        <?php
            foreach ($que as $key => $val) {
                echo "
                    <div class='question'>
                        <canvas id='data_$key'></canvas>
                    </div>";
            }
        ?>
    </div>
    <script>
        data.forEach(element => {
            // console.log(element);
            new Chart(document.getElementById(element.id), {
                type: element.type,
                data: {
                    labels: element.labels,
                    datasets: [
                        {
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#c4f850"],
                            data: element.data
                        }
                    ]
                },
                options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: element.title
                    }
                }
            })
        });
    </script>
</body>

</html>