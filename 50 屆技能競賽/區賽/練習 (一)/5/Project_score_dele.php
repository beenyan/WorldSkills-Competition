<?php
    include '../connect.php';
    mysqli_query($db, "DELETE FROM `project_score` WHERE `id` = $_GET[id]");
    header("Location:index.php");
?>