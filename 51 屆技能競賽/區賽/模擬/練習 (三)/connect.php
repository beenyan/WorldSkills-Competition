<?php
    session_start();
    $db = mysqli_connect('127.0.0.1','admin','1234','51 屆技能競賽[區賽] (3)');
    mysqli_query($db,'SET NAMES UTF8');
    include 'function.php';
    if(isset($_SESSION['m'])) {
        alert($_SESSION['m']);
        unset($_SESSION['m']);
    }