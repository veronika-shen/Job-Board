<?php
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

session_start();
sessionOn();

$id = $_GET['id'];
$categories = $pdo->query("SELECT * FROM categories");
$employments = $pdo->query("SELECT * FROM employment");

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
    <h1>Edit job</h1>
    <form action="/jobboard2/Job-Board/crud-vacancy/actions/update.php" method="post">
        <h1>Post a job</h1>

        <input type="text" name="name" placeholder="Name job">

        <label for="salary">Salary</label>
        <input type="range" id="salary" name="salary" min="10000" max="100000" step="1000" value="50000">
        <output for="salary" id="salary-output">50000</output>

        <label for="exp">Experience</label>
        <input type="number" id="exp" name="experience">

        <input type="text" name="skill_level" placeholder="Skills">

        <label for="publ">Published</label>
        <input type="date" id="publ" name="published_on">

        <label for="active">Active</label>
        <input type="checkbox" id="active" name="active" checked>

        <label for="vac">Count vacancy</label>
        <input type="number" id="vac" name="vacancy">

        <select name="category">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <select name="employment">
            <?php foreach ($employments as $employment): ?>
                <option value="<?= $employment['id'] ?>"><?= $employment['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <textarea name="description" id="editor">Description your job</textarea>
        <input type="hidden" name="id" value="<?= $id ?>">

        <input type="submit" value="Edit">
    </form>
    </body>
    </html>


