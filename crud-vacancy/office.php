<?php

require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

session_start();
sessionOn();
$id = $_SESSION['company_id'];

$company = $pdo->query("SELECT * FROM companies WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
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
<a href="/jobboard2/Job-Board/">Home page</a>
<a href="/jobboard2/Job-Board/crud-vacancy/myJobs.php">My jobs</a>
<h1>My office</h1>
<form action="actions/edit_office.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $company['name']?>">
    <input name="logo" type="file" class="custom-file-input" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03">
    <label class="custom-file-label" for="inputGroupFile03">Logo</label>
    <input type="submit" value="Обновить данные">
    <input type="hidden" value="<?= $company['id']?>"
</form>
<?php if($company['image'] != null): ?>
<img src="<?= $company['image']?>" alt="logo">
<?php endif; ?>
</body>
</html>
