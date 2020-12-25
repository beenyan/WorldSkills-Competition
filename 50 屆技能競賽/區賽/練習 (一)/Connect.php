<?php
    session_start();
    echo "<script>window.onload=()=>{document.body.setAttribute('align','center')}</script>";
    echo "<style>table {text-align: center}</style>";
    $db = mysqli_connect('localhost','admin','1234','50 屆技能競賽[區賽] (一)');
    mysqli_query($db,"SET NAMES UTF8");
?>