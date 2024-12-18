<?php

function getAllJobs($pdo)
{
    $jobs = $pdo->query("SELECT jobs.*, categories.name AS category_name, employment.name AS employment_name FROM jobs LEFT JOIN categories ON jobs.category_id = categories.id JOIN employment ON jobs.employment_id = employment.id");
}
