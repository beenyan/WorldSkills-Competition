<?php
include "connect.php";
$arr = mysqli_query($db, "SELECT * FROM `comment` WHERE side_id = $_SESSION[side_id]");
$increase = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `side` WHERE id = $_SESSION[side_id]"))['increase'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        a {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }

        img,
        video,
        audio {
            max-height: 300px;
        }


        .table_title td {
            background-color: wheat;
        }
    </style>
    <title>專案管理</title>
</head>

<body align="center">
    <table border="1" align="center" width="800">
        <tr class='table_title'>
            <td>編號</td>
            <td>標題</td>
            <td>說明</td>
            <td>發表的時間</td>
            <td>發表者的使用著名稱</td>
            <td>被評價平均分數</td>
            <td>評價人數</td>
            <td>評分</td>
            <td>延伸的意見</td>
        </tr>
        <tr>
            <?php
while ($row = mysqli_fetch_array($arr)) {
    $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE id = $row[user_id]"))["name"];
    $total_score = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(score) FROM `score` WHERE comment_id = $row[id]"))[0];
    $total_user = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `score` WHERE comment_id = $row[id]"));
    $scored = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `score` WHERE `user_id` = {$_SESSION["user"]["id"]} AND comment_id = $row[id]"));
    $comment_stratch = mysqli_query($db, "SELECT * FROM `comment_stratch` WHERE comment_id = $row[id]");
    echo "<tr class='table_title' id='comment_$row[0]'>";
    for ($i = 0; $i <= 3; ++$i) {
        echo "<td>$row[$i]</td>";
    }

    echo "<td>$user</td>"; // 發布者
    echo "<td>" . ($total_user ? round($total_score / $total_user, 2) : 3) . "</td>"; // 平均分數
    echo "<td>$total_user</td>"; // 評分人數
    // 確認是否評分
    if ($scored) {
        echo "<td>以評分</td>";
    } else {
        echo "<td>
        <form action='score.php?send=comment&comment_id=$row[0]' method='POST'>
            <select name='score'><option value='1'>1</option><option value='2'>2</option><option selected value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>
            <input type='submit' value='評分'>
        </form>
        </td>";
    }
    if (mysqli_num_rows($comment_stratch)) {
        echo "<td><select onchange='show(this)'>"; // 延伸的意見
        while ($option = mysqli_fetch_array($comment_stratch)) {
            $comment = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `comment` WHERE id = $option[comment_stratch]"));
            echo "<option value='comment_$comment[id]'>$comment[title]</option>";
        }
        echo "</select></td>";
    } else {
        echo "<td>NULL</td>";
    }

    // 檔案
    if ($row["type"] === "image") {
        echo "<tr><td colspan='10'><img src='$row[file]'></img></td></tr>";
    } else if ($row["type"] === "video") {
        echo "<tr><td colspan='10'><video src='$row[file]' controls></video></td></tr>";
    } else if ($row["type"] === "audio") {
        echo "<tr><td colspan='10'><audio src='$row[file]' controls></audio></td></tr>";
    } else {
        echo "<tr><td colspan='10'>無檔案</td></tr>";
    }

    echo "</tr>";
}
?>
    </table>
    <?php
if ($increase) {
    echo "<button onclick=\"location.href='Comment_add.php'\">新增</button>";
}

?>
    <button onclick="location.href='side.php'">Back</button>
    <script>
        function show(self) {
            location.href = `#${self.value}`;
        }
    </script>
</body>

</html>