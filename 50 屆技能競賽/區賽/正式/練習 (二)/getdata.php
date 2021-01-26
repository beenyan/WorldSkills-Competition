<?php
include 'connect.php';
$call = $_SESSION['call'];
if ($call == 'comment_much') {
    $all = mysqli_query($db, "SELECT COUNT(*) AS 'value',u.name FROM `comment` as c,`user` as u WHERE u.id = c.user_id GROUP BY user_id ORDER BY value DESC LIMIT 3");
    $arr = [
        "name" => [],
        "value" => [],
    ];
    while ($row = mysqli_fetch_assoc($all)) {
        array_push($arr["name"], $row["name"]);
        array_push($arr["value"], $row["value"]);
    }
    echo json_encode($arr);
} else if ($call == 'comment_much_count') {
    $result = [];
    $user_all = mysqli_query($db, "SELECT `user_id` as user FROM `comment` as c GROUP BY user_id ORDER BY COUNT(*) DESC LIMIT 3");
    while ($row = mysqli_fetch_array($user_all)) {
        $temp = [];
        $select = mysqli_query($db, "SELECT COUNT(*) AS VALUE FROM `score` WHERE `user_id` = $row[user] GROUP BY `score` ORDER BY `score`.`score` ASC");
        while ($row1 = mysqli_fetch_assoc($select)) {
            array_push($temp, $row1['VALUE']);
        }
        array_push($result, $temp);
    }
    echo json_encode($result);
} else if ($call == 'project_comment_count') {
    $result = [
        "name" => [],
        "value" => [],
    ];
    $arr = mysqli_query($db, "SELECT p.name,(SELECT COUNT(*) FROM comment AS c,side as s WHERE p.id = s.project_id AND c.side_id = s.id) AS value FROM project AS p");
    while ($row = mysqli_fetch_array($arr)) {
        array_push($result["name"], $row["name"]);
        array_push($result["value"], $row["value"]);
    }
    echo json_encode($result);
} else if ($call == 'count_last') {
    $result = [
        "name" => [],
        "value" => [],
        "length" => mysqli_fetch_array((mysqli_query($db, "SELECT COUNT(*) as length FROM comment AS c,side as s WHERE $_SESSION[project_id] = s.project_id AND c.side_id = s.id")))["length"],
    ];
    $arr = mysqli_query($db, "SELECT s.name, (SELECT COUNT(*) FROM comment AS c WHERE c.side_id = s.id) AS value FROM side AS s WHERE project_id = $_SESSION[project_id] GROUP BY s.id");
    while ($row = mysqli_fetch_array($arr)) {
        array_push($result["name"], $row["name"]);
        array_push($result["value"], $row["value"]);
    }
    echo json_encode($result);
}
