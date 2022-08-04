<?php


session_start();
require_once 'functions.php';

//If the user went to the direct address
// and did not send a login with a password,
// then return him to the authorization page
if (!isset($_POST['login']))
    header('Location: ../login.php');


// Get login and password
$login = sanitizeString($_POST['login']);
$password = sanitizeString($_POST['password']);
$error = '?error=';

// Checking received data
if ($login == "" || $password == "") {
    $error .= "Не все поля заполнены!";
    header('Location: ../login.php'.$error);
}
else
{
    // Check if there is a user in the database with the entered data
    $result = queryMySQL("select login, password, id_roles from users 
                                 where login='$login' and password='$password'");
    $row = $result->fetch_array(MYSQLI_NUM);

    if ($result->num_rows == 0) { // If the data is not correct, send to the authorization page and pass an error
        $error .= "Неверный логин/пароль";
        header('Location: ../login.php'.$error);
    }
    elseif ($row[2] != 1) { // If the data is not correct, send to the authorization page and pass an error
        $error .= 'Недостаточно прав';
        header('Location: ../login.php'.$error);
    }
    else
    {
        // If all data is correct, add information about the authorized user to the session
        $_SESSION['user'] = $login;
        header('Location: ../index.php');
    }
}




