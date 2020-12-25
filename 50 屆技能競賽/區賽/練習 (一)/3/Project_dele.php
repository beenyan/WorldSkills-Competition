<?php
    include '../connect.php';
    $id = $_GET['id'];
    mysqli_query($db, "DELETE FROM `project` WHERE id = $id");
    header("Location:index.php");
?>