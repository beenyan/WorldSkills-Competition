<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>控制中心</title>
    <style>
        body {
            width: 100vw;
            height: 100vh;
            margin: 0;
        }

        table {
            text-align: center;
        }
    </style>
</head>

<body align="center">
    <table border="1" cellpadding="20" align="center">
        <tr>
            <td>
                <Button onclick="location.href='2/index.php'">
                    <h1>使用者管理</h1>
                </Button>
            </td>
            <td>
                <Button onclick="location.href='3/index.php'">
                    <h1>專案管理</h1>
                </Button>
            </td>
        </tr>
        <tr>
            <td>
                <Button onclick="location.href='4/index.php'">
                    <h1>組長功能管理</h1>
                </Button>
            </td>
            <td>
                <Button onclick="location.href='5/index.php'">
                    <h1>統計管理</h1>
                </Button>
            </td>
        </tr>
    </table>
    <button onclick="location.href='index.php'">返回</button>
</body>

</html>