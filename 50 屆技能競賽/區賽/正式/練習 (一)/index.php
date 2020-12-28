<?php
    include 'connect.php';
    if (!empty($_POST)){
        $SQL = array();
        foreach ($_POST as $key => $value) {
            array_push($SQL,"`$key` LIKE '$value'");
        }
        if (count($SQL)){ // 判斷是否有資料(POST)
            $SQL = join(" AND ",$SQL);
            if ($row = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE $SQL"))){
                $_SESSION['user'] = $row;
                header('Location:Control.php');
            }
            else {
                echo "帳號密碼錯誤";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>50 屆技能競賽[區賽] - 網頁設計</title>
    <style>
        a {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <span>Account：</span><input type="text" name="account"><br><br>
        <span>Password：</span><input type="text" name="password"><br><br>
        <input type="submit">
    </form>
</body>

</html>