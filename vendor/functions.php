<?php

require 'connect.php';

function queryMySQL($query) // Make a request to the database and immediately check it
{
    global $connection;
    $result = mysqli_query($connection, $query);
    if (!$result) die($connection->error);
    return $result;
}


function returnLastID() // Returns the value generated for an AUTO_INCREMENT column by the last query
{
    global $connection;
    return $connection -> insert_id;
}

function sanitizeString($var): string // Clear string from possible sql injections for use in database query
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripcslashes($var);
    return $connection->real_escape_string($var);
}
