<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/actions/functions.php';
sessionOn();

$id = $_GET['id'];

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/database.php';

$pdo->query("DELETE FROM jobs WHERE id=$id");

header("location: ../myJobs.php");