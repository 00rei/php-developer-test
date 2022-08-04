<?php
session_start();
require_once 'vendor/functions.php';

$title = 'Авторизация';

// If the user is already logged in, send him to the main page
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

// Get the error if it was sent
$error = '';
if (isset($_GET['error']))
    $error = $_GET['error'];
?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title><?= "$title"?></title>
</head>
<body>


<h3 class="title">
    <?= "$title"?>
</h3>

<div class="content">
    <form action="vendor/auth.php" method="post">

        <?php

        echo <<<_END
    <h5 style="color: red;" class="text-center my-16">$error</h5>

<table class="last-text-right table-row-underline">
  
    <tr>
        <td>Логин:</td>
        <td><input type="text" name="login" value="" required></td>
    </tr>
    <tr>
        <td>Пароль:</td>
        <td><input type="text" name="password" value="" required></td>
    </tr>
    
    
</table>
    <h4 class="text-center my-16">
        <input type="submit" class="bth-page" value="Войти">
    </h4>

_END;
        ?>

    </form>
</div>
</body>
</html>