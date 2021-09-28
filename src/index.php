<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("db", "root", "root", "myapp");


/* Запросы SELECT, возвращают набор результатов */
$result = $mysqli->query("SELECT * FROM users");
printf("Запрос SELECT вернул %d строк.\n", $result->num_rows);

?>

<!DOCTYPE html>

<head>
    <title>AdminPanel</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h1>Admin Panel</h1>
    <table class="adminTable">
        <td><a href="/users" class="aMain"><button class="btn-control">Manage Users</button></a></td>
        <td><a href="/docs" class="aMain"><button class="btn-control">Manage Documents</button></a></td>
    </table>
</body>
</html>