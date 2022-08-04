<?php

//  Check if the user is authorized and if not, send him to the authorization page
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}