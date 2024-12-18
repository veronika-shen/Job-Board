<?php

session_start();
unset($_SESSION['company_id']);
header('Location: /jobboard2/');
