<?php
    include 'connect.php';
    DB::work("DELETE FROM `form` WHERE `invite` LIKE '$_GET[invite]'");
    $_SESSION['message'] = '刪除成功';
    href('manage.php');
?>