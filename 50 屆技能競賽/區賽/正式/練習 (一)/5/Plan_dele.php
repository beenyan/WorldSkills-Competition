<?php
    include '../connect.php';
    $id = $_GET['id'];
    mysqli_query($db, "DELETE FROM `plan` WHERE id = $id");
    header("Location:Plan.php");
?>