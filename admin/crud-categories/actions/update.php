<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$is_popular = isset($_POST['is_popular']) ? 1 : 0;

$pdo->query("UPDATE categories SET name = '$name',is_popular = '$is_popular' WHERE id = '$id'");

header("location: /jobboard2/admin/crud-categories/index.php");