<?php
    include '../connect.php';
    $id = $_GET['id'];
    $mod = $_GET['mod'];
    $time = $_GET['time'];
    mysqli_query($db, "UPDATE `plan` SET $mod=$time WHERE id = $id");
    header("Location:Plan.php");
?>