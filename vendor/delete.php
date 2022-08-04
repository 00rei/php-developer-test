<?php

require_once 'check_user.php';
require_once 'functions.php';

// If the id of the user to be deleted was not passed, send the user to the main page
if (!isset($_GET['id']))
    header('Location: /');

//  Clear string with ID, delete user, return to index.php
$id = sanitizeString($_GET['id']);
$sql = 'DELETE FROM `users` WHERE `users`.`id` = '.$id;
queryMySQL($sql);
header('Location: /');