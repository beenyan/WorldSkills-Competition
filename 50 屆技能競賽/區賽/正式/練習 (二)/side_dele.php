<?php
include "connect.php";
mysqli_query($db, "DELETE FROM `side` WHERE `id` = $_SESSION[side_id]");
header("Location:side.php");
