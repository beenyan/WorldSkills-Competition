<?php
    include '../connect.php';
    $arr = mysqli_query($db, "SELECT * FROM `plan` WHERE project_id = $_SESSION[project]");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>執行方案</title>
</head>

<body>
    <table border="1" cellpadding="5" width="1000" align="center">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Detail</td>
            <td>開始評分</td>
            <td>結束評分</td>
            <td>修改</td>
            <td>刪除</td>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($arr)) {
                $start_date = date("Y-m-d\TH:i", $row['start_time'] + 3600 * 7);
                $end_date = date("Y-m-d\TH:i", $row['end_time'] + 3600 * 7);
                echo "<tr>";
                for ($i = 0; $i <= 2; ++$i){
                    echo "<td>$row[$i]</td>";
                }
                echo "<td><input type='datetime-local' id='$row[0]' onblur='start(this)' value='$start_date'></td>";
                echo "<td><input type='datetime-local' id='$row[0]' onblur='end(this)' value='$end_date'></td>";
                echo "<td><a href='../set.php?plan=$row[0]&url=5/Plan_edit.php'>修改</a></td>";
                echo "<td><a href='Plan_dele.php?id=$row[0]'>刪除</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="location.href='Plan_add.php'">新增</button>
    <button onclick="location.href='index.php'">返回</button>
    <script>
        function start(self) {
            location.href = `Plan_time.php?id=${self.id}&mod=start_time&time=${Math.floor(+new Date(self.value) / 1000)}`;
        }
        function end(self) {
            location.href = `Plan_time.php?id=${self.id}&mod=end_time&time=${Math.floor(+new Date(self.value) / 1000)}`;
        }
    </script>
</body>

</html>