<?php
    include '../connect.php';
    mysqli_query($db, "UPDATE `project_score` SET `name`='$_POST[name]' WHERE `id` = $_GET[id]");
    header("Location:index.php");
?>