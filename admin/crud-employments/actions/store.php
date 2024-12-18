<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/database.php';

$name = $_POST['name'];
$pdo->query("INSERT INTO employment (name) VALUES ('$name')");

header("location: /jobboard2/Job-Board/admin/crud-employments/index.php");