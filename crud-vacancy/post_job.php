<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/Job-Board/actions/functions.php';
sessionOn();

/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

$categories = $pdo->query("SELECT * FROM categories");
$employments = $pdo->query("SELECT * FROM employment");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/jobboard2/Job-Board/css/myStyle.css">
    <title>Job Board</title>
</head>
<body>
<form action="/jobboard2/Job-Board/crud-vacancy/actions/store.php" method="post">
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

    <input type="submit" value="Post">
</form>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
<script>
    const salaryRange = document.getElementById('salary');
    const salaryOutput = document.getElementById('salary-output');

    salaryRange.addEventListener('input', () => {
        salaryOutput.value = salaryRange.value;
    });
</script>
</body>
</html>