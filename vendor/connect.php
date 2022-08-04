<?php

//  Set options to configure database connection
$host = 'localhost';    //hostname
$name = 'php_test';     // database name
$user = 'root';         //username
$password = '';         //password

//  Initializing and checking the connection for errors
$connection = new mysqli($host, $user, $password, $name);
if ($connection->connect_error)
    die ($connection->connect_error);
