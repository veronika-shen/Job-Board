<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
sessionOn();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'].'/jobboard2/database.php';
$id = $_POST['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$salary = $_POST['salary'];
$employment = $_POST['employment'];
$experience = $_POST['experience'];
$skill_level = $_POST['skill_level'];
$published = $_POST['published_on'];
$description = $_POST['description'];
$active = isset($_POST['active']) ? 1 : 0;

$pdo->query("UPDATE jobs SET name='$name', category_id='$category', salary='$salary', employment_id='$employment', experience='$experience',
                skill_level='$skill_level', published_on='$published', description='$description', active='$active' WHERE id='$id' ");

header("location: /jobboard2/crud-vacancy/myJobs.php");