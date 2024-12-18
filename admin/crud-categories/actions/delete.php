<?php

$id = $_GET['id'];

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/database.php';
$pdo->query("DELETE FROM categories WHERE id = '$id'");

header("location: /jobboard2/Job-Board/admin/crud-categories/index.php");