<?php
require_once 'check_user.php';
require_once 'functions.php';

if (!isset($_POST['id']))
    header('Location: /');

// Clear received rows
$id = sanitizeString($_POST['id']);
$login = sanitizeString($_POST['login']);
$password = sanitizeString($_POST['password']);
$name = sanitizeString($_POST['name']);
$surname = sanitizeString($_POST['surname']);
$date_of_birth = sanitizeString($_POST['date_of_birth']);
$id_genders = sanitizeString($_POST['genders']);
$id_roles = sanitizeString($_POST['roles']);

// If an identifier was received that is not equal to "new",
// then update the user information, otherwise create a new record
if (isset($_POST['id']) && $id != 'new'){
    $sql = "UPDATE `users` SET `login` = '$login', `password` = '$password', `name` = '$name', `surname` = '$surname', 
                   `date_of_birth` = '$date_of_birth', `id_genders` = '$id_genders', `id_roles` = '$id_roles' 
                    WHERE `users`.`id` = $id;";
        $results = queryMySQL($sql);
    header('Location: ../full_view.php?id='.$id); // Open updated user information
}
elseif($id == 'new') {
    $sql = "INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `date_of_birth`, `id_genders`, `id_roles`)
            VALUES (NULL, '$login', '$password', '$name', '$surname', '$date_of_birth', '$id_genders', '$id_roles');";
    $results = queryMySQL($sql);
    $last_id = returnLastID(); // Get the last generated ID
    header('Location: ../full_view.php?id='.$last_id); // Open new user information
}
