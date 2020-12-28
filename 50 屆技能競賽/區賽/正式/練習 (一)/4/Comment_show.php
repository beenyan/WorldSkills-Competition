<?php
    include '../connect.php';
    mysqli_query($db, "UPDATE `side` SET `increase` = increase ^ 1 WHERE id = $_SESSION[side]");
    header("Location:../3/Side.php");
?>