<?php


require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

session_start();
sessionOn();
$company_id = $_SESSION['company_id'];
$job_id = $_GET['id'];

$job = $pdo->query("SELECT jobs.*, categories.name AS category_name, employment.name AS employment_name 
                    FROM jobs 
                    LEFT JOIN categories ON categories.id = jobs.category_id 
                    JOIN employment ON employment.id = jobs.employment_id
                    WHERE jobs.id = '$job_id'")->fetch();
$responses = $pdo->query("SELECT * FROM responses WHERE job_id = '$job_id'")->fetchAll();
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
<body>
<h2><?= $job['name']?></h2>
<h4><?= $job['category_name']?></h4>
<?= $job['description']?>
<h3>Job Summery</h3>
</div>
<div class="job_content">
    <ul>
        <li>Published on: <span><?= $job['published_on']?></span></li>
        <li>Vacancy: <span><?= $job['vacancy']?> Position</span></li>
        <li>Salary: <span><?= $job['salary']?>k/y</span></li>
        <li>Location: <span>California, USA</span></li>
        <li>Job Nature: <span><?= $job['employment_name']?></span></li>
    </ul>
</div>
<h4>Responses</h4>

<div class="cards-container">
    <?php foreach ($responses as $response): ?>
    <div class="job-card">
        <h3><?= $response['name']?></h3>
        <h2><?= $response['email']?></h2>
        <p><?= $response['coverletter']?></p>
        <p><?= $response['website_link']?></p>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>
