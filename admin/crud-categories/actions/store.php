<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/database.php';

$name = $_POST['name'];
$is_popular = isset($_POST['is_popular']) ? 1 : 0;

$pdo->query("INSERT INTO categories (name,is_popular) VALUES ('$name','$is_popular')");

header("location: /jobboard2/Job-Board/admin/crud-categories/index.php");