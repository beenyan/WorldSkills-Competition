<?php
include "connect.php";
mysqli_query($db, "DELETE FROM `user` WHERE `id` = $_SESSION[user_id]");
header("Location:user.php");
