<?php

require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

session_start();
sessionOn();

$id = $_SESSION['company_id'];
$name = $_POST['name'];

if(!empty($_FILES['logo']['tmp_name'])){
    $path = "/images/" . $_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $path);
}else{
    $path = null;
}

$pdo->query("UPDATE companies SET name='$name', image='$path' WHERE id='$id'");

header('location: /jobboard2/crud-vacancy/office.php');