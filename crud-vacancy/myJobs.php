<?php

require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

session_start();
sessionOn();
$company_id = $_SESSION['company_id'];


$jobs = $pdo->query("SELECT * FROM `jobs` WHERE company_id = '$company_id'");
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/jobboard2/css/myStyle.css">
    <title>Job Board</title>
</head>
<body class="myJobs">
<header>
    <a href="/jobboard2/">Home page</a>
    <a href="/jobboard2/crud-vacancy/">All jobs</a>
    <a href="/jobboard2/crud-vacancy/office.php">My office</a>
</header>
    <main>
        <h1>My jobs</h1>
        <a href="/jobboard2/crud-vacancy/post_job.php">Apply job</a>
        <div class="cards-container">
        <?php foreach ($jobs as $job) : ?>
            <div class="job-card">
                <h3><?= $job['name']?></h3>
                <?= $job['description']?>
                <p>Vacancy:<?= $job['vacancy']?></p>
                <p>Date published:<?= $job['published_on']?></p>
                <a href="/jobboard2/crud-vacancy/office.php?id=<?= $job['id']?>">Edit</a>
                <a href="/jobboard2/crud-vacancy/actions/delete.php?id=<?= $job['id']?>">Delete</a>
                <a href="actions/job.php?id=<?= $job['id']?>">More</a>
            </div>
        <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
