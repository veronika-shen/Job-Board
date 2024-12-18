<?php
/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$pdo->query("INSERT INTO companies (name, email, password) VALUES ('$name', '$email', '$password')");

$company_id = $pdo->lastInsertId();

$_SESSION['company_id'] = $company_id;

header('Location: /jobboard2/Job-Board/index.php');

