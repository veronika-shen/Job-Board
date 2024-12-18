<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
isAdmin();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';
$employments = $pdo->query("SELECT * FROM employment")->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>Employments</h1>
    <a href="/jobboard2/Job-Board/admin/crud-employments/create.php">Create employment</a>
    <table>
        <thead>
        <tr>
            <td>id</td>
            <td>name employment</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($employments as $employment): ?>
        <tr>
            <td><?= $employment['id']?></td>
            <td><?= $employment['name']?></td>
            <td><a href="/jobboard2/Job-Board/admin/crud-employments/edit.php?id=<?= $employment['id']?>">Edit</a></td>
            <td><a href="/jobboard2/Job-Board/admin/crud-employments/actions/delete.php?id=<?= $employment['id']?>">Delete</a></td>
        </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>
