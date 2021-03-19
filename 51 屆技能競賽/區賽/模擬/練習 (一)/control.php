<?php
    include 'connect.php';
    $c = $_GET['c'];
    if ($c =='insert'){
        mysqli_query($db,$_POST['sql']);
    } else if ($c == 'work'){
        DB::work($_POST['sql']);
    }
    else if ($c == 1){
        $invite = $_POST['invite'];
        if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `form` WHERE `invite` LIKE '$invite'")))
            res(403,'邀請碼重複');
        else res();
    } else if ($c == 2){
        $invite = $_POST['invite'];
        if (mysqli_num_rows(mysqli_query($db,$_POST['sql'])))
            res(403,'邀請碼重複');
        else res();
    } else if ($c == 3){
        
    } else if ($c == 4){
        
    } else if ($c == 5){
        
    } else if ($c == 6){
        
    } else if ($c == 7){
        
    } else if ($c == 8){
        
    }
?>