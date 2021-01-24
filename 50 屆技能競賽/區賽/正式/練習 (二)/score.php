<?php
include 'connect.php';
if ($_SESSION["send"] === "comment") {
    mysqli_query($db, "INSERT INTO score(score,user_id,comment_id) VALUES ($_POST[score],{$_SESSION['user']['id']},$_SESSION[comment_id])");
    header("Location:comment.php");
}