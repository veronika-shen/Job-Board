<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
isAdmin();

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h1>Create employment</h1>
<form action="/jobboard2/Job-Board/admin/crud-employments/actions/store.php" method="post">
    <input type="text" name="name">
    <input type="submit" value="Create">
</form>
</body>
</html>
