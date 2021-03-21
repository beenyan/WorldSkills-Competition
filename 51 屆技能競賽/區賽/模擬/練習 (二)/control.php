<?php
    include 'connect.php';
    $c = $_GET['c'];
    if ($c =='query'){
        echo json_encode(DB::query($_POST['sql']));
    } else if ($c == 'work'){
        DB::work($_POST['sql']);
    } else if ($c == 'copy'){
        
    }
?>