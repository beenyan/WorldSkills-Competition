<?php
include 'connect.php';
if ($_SESSION['send'] === 'side') {
    mysqli_query($db, "UPDATE `side` SET `increase` = increase ^ 1 WHERE id = $_SESSION[side_id]");
    header("Location:side.php");
}
