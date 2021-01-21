<?php
session_start();
$db = mysqli_connect('127.0.0.1', 'admin', '1234', '50 屆技能競賽[區賽] (二)') or die('資料庫連接失敗');
mysqli_query($db, "SET NAMES UTF8");
foreach ($_GET as $key => $value) {
    $_SESSION[$key] = $value;
}