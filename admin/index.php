<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/actions/functions.php';
isAdmin();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Board</title>
</head>
<body>
    <h1>Admin</h1>
    <a href="crud-categories/">Categories</a>
    <a href="crud-employments/">Employments</a>
    <a href="/jobboard2/index.php">Main</a>
</body>
</html>
