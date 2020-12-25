<?php
    include '../connect.php';
    $id = $_GET['id'];
    $side = $_GET['side'];
    mysqli_query($db, "DELETE FROM `side` WHERE id = $side");
    header("Location:Side.php?id=$id");
?>