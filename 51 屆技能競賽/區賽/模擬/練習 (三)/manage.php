<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Include/jquery.js"></script>
    <script src="function.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>web</title>
</head>

<body>
    <div class="title">
        <button onclick="href('index.php')">BACK</button>
    </div>
    <div class="block_title"></div>

    <table align="center" border="1">
        <tr>
            <td>
                <h1>新增問卷</h1>
                <form action="insert.php" method="GET">
                    問卷數量 <input type="number" min='1' name="number" required><br><br>
                    <input type="submit">
                </form>
            </td>
        </tr>
    </table>
    <script>

    </script>
</body>

</html>