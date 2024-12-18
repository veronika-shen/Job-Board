<?php

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/database.php';

$job_id = $_POST['job_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website_link'];
$coverletter = $_POST['coverletter'];

if(!empty($_FILES['file']['tmp_name'])){
    $path = "/images/" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $path);
}else{
    $path = null;
}

$pdo->query("INSERT INTO responses(name, email, website_link, coverletter,path, job_id) 
        VALUES('$name', '$email', '$website','$coverletter','$path','$job_id')");

header('Location: /jobboard2/');