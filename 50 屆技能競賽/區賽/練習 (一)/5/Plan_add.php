<?php
    include '../connect.php';
    $side = mysqli_query($db, "SELECT * FROM `side` WHERE project_id = $_SESSION[project]");
    if (!empty($_POST)){
        $SQL = array(
            "key"=>array(),
            "value"=>array()
        );
        foreach ($_POST as $key => $value) {
            array_push($SQL["key"],"`$key`");
            array_push($SQL["value"],"'$value'");
        }
        foreach ($SQL as $key => $value) {
            $SQL[$key] = "(".join(' , ',$value).")";
        }
        $SQL = join(" Values ",$SQL);
        echo "INSERT INTO `SMT` $SQL";
        // mysqli_query($db, "INSERT INTO `SMT` $SQL");
        echo "新增成功";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>執行方案</title>
</head>

<body>
    <form action="" method="post">
        <span>執行方案名稱：</span><input required type="name" name="name"><br><br>
        <span>執行方案說明：</span><input required type="name" name="detail"><br><br>
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
                    echo "<tr><td colspan='10'>";
                    while ($comment_row = mysqli_fetch_array($comment)) {
                        $score = max(0,mysqli_fetch_array(mysqli_query($db, "SELECT ROUND(AVG(`score`),2) FROM `score` WHERE `comment_id` = $comment_row[0]"))[0]);
                        echo "<input required type='radio' name='$side_row[0]' id='$comment_row[0]'><label for='$comment_row[0]'>$comment_row[1] Score：$score</label><br><br>";
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