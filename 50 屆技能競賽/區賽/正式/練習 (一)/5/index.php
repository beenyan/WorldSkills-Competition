<?php
    include '../connect.php';
    $arr = mysqli_query($db, "SELECT * FROM `project` WHERE leader = {$_SESSION['user']["id"]}");
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


        .table_title td {
            background-color: wheat;
        }
        form{
            display:inline-block;
        }
    </style>
    <title>組長功能管理</title>
</head>

<body>
    <table border="1" cellpadding="5" width="600" align="center">
        <?php
            while ($row = mysqli_fetch_array($arr)){
                $project_score = mysqli_query($db, "SELECT * FROM `project_score` WHERE project_id = $row[0]");
                echo "<tr class='table_title'>";
                for ($i = 1; $i <= 2; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                echo "<td><a href='../set.php?project=$row[0]&url=5/Plan.php'>執行方案管理</a></td>";
                // 評分指標
                echo "<tr><td colspan='10'><ui>";
                while ($score = mysqli_fetch_array($project_score)) {
                    echo "<li><form action='Project_score_edit.php?id=$score[0]' method='POST'>
                        <input type='text' required name='name' value='$score[name]'> <input type='submit' value='修改'>
                        </form><button onclick=\"location.href='Project_score_dele.php?id=$score[0]'\">刪除</button></li>";
                }
                echo "
                    </ui><form action='Project_score_add.php' method='POST'>
                        <input type='hidden' name='project_id' value='$row[0]'>
                        <span>名稱：</span><input required type='text' name='name'> <input type='submit' value='新增評分指標'>
                    </form>
                ";
                echo "</td></tr>";
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='../Control.php'">返回</button>
</body>

</html>