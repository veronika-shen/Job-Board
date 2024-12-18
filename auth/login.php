<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$company = $pdo->query("SELECT * FROM companies WHERE email = '$email'")->fetch(pdo::FETCH_ASSOC);

if(!$company || !$company['password'] = $password){
header("location: /jobboard2/Job-Board/login.html");
exit;
}

$_SESSION['company_id'] = $company['id'];

$_SESSION['isAdmin'] = $company['is_admin'] == 1 ? 1 : 0;

header('location: /jobboard2/Job-Board/index.php');

