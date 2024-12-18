<?php
session_start();

/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
sessionOn();

$name = $_POST['name'];
$slug = generateSlug($_POST['name']);
$salary = $_POST['salary'];
$category = $_POST['category'];
$employment = $_POST['employment'];
$experience = $_POST['experience'];
$skills = $_POST['skill_level'];
$published_on = $_POST['published_on'];
$description = $_POST['description'];
$active = isset($_POST['active']) ? 1 : 0;
$vacancy = $_POST['vacancy'];
$company = $_SESSION['company_id'];


$pdo->query(
    "INSERT INTO jobs(name, slug, salary, category_id, employment_id, experience, skill_level, published_on, description, active, vacancy, company_id)
            VALUES ('$name','$slug','$salary','$category','$employment','$experience','$skills','$published_on','$description','$active','$vacancy','$company')");

header('Location: /jobboard2/Job-Board/crud-vacancy/myJobs.php');