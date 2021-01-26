<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <script src='http://code.highcharts.com/highcharts.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
    <style>
        .box {
            width: 70vw;
            height: auto;
            display: inline-block;
        }
    </style>
    <title>各專案意見發表總數量統計</title>
</head>

<body align="center">
    <span>各專案意見之各面向統計：</span>
    <select onchange="getdata(this.value)">
        <?php
            $arr = mysqli_query($db, "SELECT p.id,p.name FROM project as p");
            while ($row = mysqli_fetch_array($arr)) {
                echo "<option value='$row[id]'>$row[name]</option>";
            }
        ?>
    </select><br>
    <span id="nums"></span><br>
    <div class='box'>
        <canvas id='canvas'></canvas>
    </div><br>
    <button onclick="location.href='count.php'">Back</button>
    <script>
        let rename;
        function getdata(id) {
            $.ajax({
                url: `getdata.php?call=count_last&project_id=${id}`,
                async: false,
                success: data => draw(JSON.parse(data))
            });
        }
        function draw(data) {
            if (rename) rename.destroy();
            $("#nums").text(`總意見數：${data.length}`);
            rename = new Chart(document.getElementById('canvas').getContext('2d'), {
                type: 'doughnut',
                options: { // 從 0 開始
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                },
                data: {
                    labels: data['name'],
                    datasets: [{
                        label: '各專案意見發表總數量統計',
                        data: data['value'],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(0, 203, 150, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(0, 203, 150, 1)'
                        ],
                        borderWidth: 3
                    }]
                }
            });
        }
        getdata($("select").val())
    </script>
</body>

</html>