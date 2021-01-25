<?php
include 'connect.php';
mysqli_query($db, "DELETE FROM `plan` WHERE id = $_SESSION[plan_id]");
header("Location:plan_view.php");
