<?php
    include 'connect.php';
    $quest = new DB("SELECT * FROM `question` WHERE `invite` LIKE '$_GET[invite]' AND type != 4");
    $type = [
        1 => "pie",
        2 => "pie",
        3 => "horizontalBar",
    ];
    $data = [];
    foreach ($quest->data as $key => $val) {
        if ($quest->length == 1) continue;
        $ret = [
            "id" => $val->id.$val->invite,
            "type" => $type[$val->type],
            "title" => $val->title,
            "labels" => [],
            "data" => []
        ];
        if ($val->type == 1){
            $ret['labels'] = ['是', '否'];
        } else {
            for ($i = 4; $i <= 9; ++$i) {
                if ($val->$i === '') continue;
                array_push($ret['labels'], $val->$i);
            }
        }
        if ($val->type == 1) {
            $q = new DB("SELECT SUM(`ques1`) as ques1,SUM(`ques2`) as ques2 FROM `response` WHERE `question_id` = $val->id");
            $ret['data'] = [$q->data->ques1, $q->data->ques2];
        } else {
            $q = new DB("SELECT SUM(`ques1`),SUM(`ques2`),SUM(`ques3`),SUM(`ques4`),SUM(`ques5`),SUM(`ques6`) FROM `response` WHERE `question_id` = $val->id");
            for ($i=0; $i < count($ret['labels']); ++$i) { 
                array_push($ret['data'],$q->data->$i);
            }
        }
        array_push($data,$ret);
    }
    $data = json_encode($data);
    echo "<script>let data = $data</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <script src="Include/chart.js"></script>
    <script src='function.js'></script>
    <link rel="stylesheet" href="Main.css">
    <title>圖表統計</title>
</head>

<body>
    <div class="head">
        <div class="title" id="title">圖表統計</div>
        <button class="button" onclick="location.href='manage.php'">Back</button>
    </div>
    <div class="box">
        <?php
            foreach ($quest->data as $key => $val) {
                if ($quest->length == 1) continue;
                $id = $val->id.$val->invite;
                echo "<div class='question'>
                    <canvas id='{$id}'></canvas>
                </div>";
            }
        ?>
    </div>
    <script>
        data.forEach(element => {
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