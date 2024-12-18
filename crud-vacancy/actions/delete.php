<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/actions/functions.php';
sessionOn();

$id = $_GET['id'];

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

$pdo->query("DELETE FROM jobs WHERE id=$id");

header("location: .../myJobs.php");