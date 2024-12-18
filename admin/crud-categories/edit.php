<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
isAdmin();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

$id = $_GET['id'];
$name = $_GET['name'];
$is_popular = $pdo->query("SELECT is_popular FROM categories WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);

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
    <h1>Edit category</h1>
    <form action="actions/update.php" method="post">
        <input type="text" name="name" value="<?= $name?>" placeholder="New name">
        <lable for="checkbox">Popular</lable>
        <?php if($is_popular['is_popular'] == 0):?>
        <input type="checkbox" id="checkbox" name="is_popular">
        <?php else:?>
        <input type="checkbox" id="checkbox" name="is_popular" checked>
        <?php endif;?>
        <input type="submit" value="Edit">
        <input type="hidden" name="id" value="<?= $id?>">
    </form>
</body>
</html>
