<?php

//Logout. Clearing the session from information about the authorized user
session_start();
$_SESSION=array();
header('Location: ../login.php');
exit;

