<?php
include 'connect.php';
if ($_SESSION['send'] === 'side') {
    mysqli_query($db, "UPDATE `side` SET `increase` = increase ^ 1 WHERE id = $_SESSION[side_id]");
    header("Location:side.php");
} else if ($_SESSION['send'] === 'plan') {
    mysqli_query($db, "UPDATE `plan` SET `mode` = mode + 1 WHERE id = $_SESSION[plan_id]");
    header("Location:plan_view.php");
} else if ($_SESSION['send'] === 'plan_score') {
    mysqli_query($db, "INSERT INTO `plan_score`(`score`, `plan_id`, `user_id`) VALUES ($_SESSION[score],$_SESSION[plan_id],{$_SESSION['user']['id']})");
    header("Location:user_plan.php");
} else if ($_SESSION['send'] === 'plan_view') {
    mysqli_query($db, "UPDATE `project` SET `view`= `view` ^ 1 WHERE `id` = $_SESSION[project_id]");
    header("Location:leader.php");
}
