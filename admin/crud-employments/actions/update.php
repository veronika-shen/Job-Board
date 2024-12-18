<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

$id = $_POST['id'];
$name = $_POST['name'];

$pdo->query("UPDATE employment SET name = '$name' WHERE id = '$id'");

header("location: /jobboard2/Job-Board/admin/crud-employments/index.php");