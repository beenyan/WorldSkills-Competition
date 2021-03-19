<?php
    session_start();
    $db = mysqli_connect('localhost','admin','1234','51 屆技能競賽[區賽] (一)');
    mysqli_query($db, 'Set Names UTF8');
    include 'function.php';
    if (isset($_SESSION['message'])){
        alert($_SESSION['message']);
        unset($_SESSION['message']);
    }
?>