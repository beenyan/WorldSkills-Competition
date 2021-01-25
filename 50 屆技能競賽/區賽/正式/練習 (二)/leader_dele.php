<?php
include "connect.php";
mysqli_query($db, "DELETE FROM `leader` WHERE `id` = $_SESSION[leader_id]");
header("Location:leader_view.php");
