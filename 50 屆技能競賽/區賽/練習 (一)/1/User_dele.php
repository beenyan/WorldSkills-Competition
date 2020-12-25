<?php
    include '../connect.php';
    $SQL = array();
    foreach ($_GET as $key => $value) {
        array_push($SQL,"`$key` LIKE '$value'");
    }
    if (count($SQL)){ // 判斷是否有資料(GET)
        $SQL = join(" AND ",$SQL);
        $arr = mysqli_query($db, "DELETE FROM `user` WHERE $SQL");
        header('Location:User.php');
    }
    echo "<script>alert('刪除失敗')</script>";
    header('Location:User.php');
?>