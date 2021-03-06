<?php
    include '../connect.php';
    if (!empty($_POST)){
        $_POST['start_time'] = strtotime($_POST['start_time']);
        $_POST['end_time'] = strtotime($_POST['end_time']);
        $id = $_SESSION["plan"];
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,8) === "comment_") continue;
            array_push($SQL,"`$key` = '$value'");
        }
        $SQL = join(" , ",$SQL);
        mysqli_query($db, "UPDATE `plan` SET $SQL WHERE `id` = $id");
        
        $SQL = array();
        foreach ($_POST as $key => $value) {
            if (substr($key,0,8) !== "comment_") continue;
            array_push($SQL,"(".join(",",array($id,$value)).")");
        }
        $SQL = join(",",$SQL);
        mysqli_query($db, "DELETE FROM `plan_comment` WHERE `plan_id` = $id");
        mysqli_query($db, "INSERT INTO `plan_comment`(`plan_id`,`comment_id`) VALUES $SQL");
        echo "修改成功";
    }
    out:
    $plan = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `plan` WHERE id = $_SESSION[plan]"));
    $side = mysqli_query($db, "SELECT * FROM `side` WHERE `project_id` in (SELECT `project_id` FROM `plan` WHERE `id` = $_SESSION[plan])");
    $start_date = ($plan['start_time']? date("Y-m-d\TH:i", $plan['start_time'] + 3600 * 7): date("Y-m-d\TH:i", time() + 3600 * 7));
    $end_date = ($plan['end_time']? date("Y-m-d\TH:i", $plan['end_time'] + 3600 * 7): date("Y-m-d\TH:i", time() + 3600 * 31));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>執行方案修改</title>
</head>

<body>
    <form action="" method="POST">
        <span>執行方案名稱：</span><input required value='<?php echo $plan["name"]; ?>' type="name" name="name"><br><br>
        <span>執行方案說明：</span><input required value='<?php echo $plan["detail"]; ?>' type="name" name="detail"><br><br>
        <span>開始評分：</span><input required type='datetime-local' name="start_time" value='<?php echo $start_date; ?>'><br><br>
        <span>停止評分：</span><input required type='datetime-local' name="end_time" value='<?php echo $end_date; ?>'><br><br>
        
        <table border="1" cellpadding="5" width="1000" align="center">
            <?php
                while ($side_row = mysqli_fetch_array($side)){
                    $comment = mysqli_query($db, "SELECT * FROM `comment` WHERE side_id = $side_row[id]");
                    echo "<tr>";
                    echo "<td>面相</td>";
                    for ($i = 0; $i <= 2; ++$i){
                        echo "<td>$side_row[$i]</td>";
                    }
                    // 意見
                    echo "<tr><td>意見</td><td colspan='10' style='text-align: left;'>";
                    while ($comment_row = mysqli_fetch_array($comment)) {
                        $checked = (mysqli_num_rows(mysqli_query($db, "SELECT * FROM `plan_comment` WHERE comment_id = $comment_row[0] AND plan_id = $_SESSION[plan]"))? "checked": "");
                        $score = max(0,mysqli_fetch_array(mysqli_query($db, "SELECT ROUND(AVG(`score`),2) FROM `score` WHERE `comment_id` = $comment_row[0]"))[0]);
                        echo "<input $checked required type='radio' value='$comment_row[0]' name='comment_$side_row[0]' id='$comment_row[0]'><label for='$comment_row[0]'>$comment_row[1] Score：$score</label><br><br>";
                    }
                    echo "</td></tr>";
                    echo "</tr>";
                }
            ?>
        </table>
        <input type="submit">
    </form>
    <button onclick="location.href='Plan.php'">返回</button>
</body>

</html>