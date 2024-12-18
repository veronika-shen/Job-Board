<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
sessionOn();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';
$jobs = $pdo->query("SELECT * FROM `jobs`");

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/jobboard2/Job-Board/css/myStyle.css">
    <title>Job Board</title>
</head>
<body class="myJobs">
<header>
    <a href="/jobboard2/Job-Board/">Home page</a>
    <a href="/jobboard2/Job-Board/crud-vacancy/myJobs.php">My jobs</a>
    <a href="/jobboard2/Job-Board/crud-vacancy/office.php">My office</a>
</header>
    <h1>All vacancy</h1>
<div class="cards-container">
    <?php foreach ($jobs as $job) : ?>
    <div class="job-card">
        <h3><?= $job['name']?></h3>
        <?= $job['description']?>
        <p>Vacancy:<?= $job['vacancy']?></p>
        <p>Date published:<?= $job['published_on']?></p>
        <a href="actions/more_job.php?id=<?= $job['id']?>">More</a>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>
