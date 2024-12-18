<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
isAdmin();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';
$category = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

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
<header>
    <a href="/jobboard2/Job-Board/admin/">Admin</a>
</header>
<main>
    <h1>Categories</h1>
    <a href="/jobboard2/Job-Board/admin/crud-categories/create.php">Create category</a>
    <table>
        <thead>
        <tr>
            <td>id</td>
            <td>name category</td>
            <td>Popular/No popular</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($category as $category): ?>
        <tr>
            <td><?= $category['id']?></td>
            <td><?= $category['name']?></td>
            <td>
                <?php if($category['is_popular'] == 1): ?>
                    Popular
                <?php else: ?>
                    No popular
                <?php endif; ?>
            </td>
            <td><a href="/jobboard2/Job-Board/admin/crud-categories/edit.php?id=<?= $category['id']?>&name=<?= $category['name']?>">Edit</a></td>
            <td><a href="/jobboard2/Job-Board/admin/crud-categories/actions/delete.php?id=<?= $category['id']?>">Delete</a></td>
        </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>
