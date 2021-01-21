<?php
include "connect.php";
mysqli_query($db, "DELETE FROM `project` WHERE `id` = $_SESSION[project_id]");
header("Location:project.php");
