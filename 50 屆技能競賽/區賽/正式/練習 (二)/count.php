<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .box {
            width: 30vw;
            height: auto;
            display: inline-block;
        }

        @media (max-width: 800px) {
            .box {
                width: 80vw;
            }
        }
    </style>
    <title>統計管理</title>
</head>

<body align="center">
    <button onclick="location.href='lobby.php'">Back</button>
    <h3>發表意見最高前三位</h3>
    <div class="box">
        <canvas id="comment_much"></canvas>
    </div>
    <h3>發表意見最高前三位 - 評分次數</h3>
    <div class="box">
        <h4>第一名</h4>
        <canvas id="comment_much_count1"></canvas>
    </div>
    <div class="box">
        <h4>第二名</h4>
        <canvas id="comment_much_count2"></canvas>
    </div>
    <div class="box">
        <h4>第三名</h4>
        <canvas id="comment_much_count3"></canvas>
    </div><br>
    <button onclick="location.href='project_comment_count.php'">各專案意見發表總數量統計</button>
    <button onclick="location.href='count_last.php'">各專案意見之各面向統計</button>
    <script src="main.js"></script>
</body>

</html>