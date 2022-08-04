<?php
require_once 'vendor/check_user.php';
require_once 'vendor/functions.php';

if (!isset($_GET['id']))
    header('Location: /');


$id_user = sanitizeString($_GET['id']);  //Clear string

// Database query for user information
$sql = "select u.id, u.login, u.password, u.name, u.surname, u.date_of_birth, g.name, r.name 
        from users u, genders g, roles r
        where u.id_genders = g.id and u.id_roles = r.id and u.id = $id_user";
$results = queryMySQL($sql);
$user = $results -> fetch_row(); //Array with user information


?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title><?= "$user[3] $user[4]"?></title>
</head>
<body>

<p class="hello-admin">
    Добрый день, <?= $_SESSION['user'] ?>. <a href="vendor/logout.php">Выйти</a>
</p>

<h3 class="title">
    <?= "$user[7] – $user[3] $user[4]"?>
</h3>

<div class="content">


<?php

echo <<<_END
<table class="last-text-right table-row-underline">
    <tr>
        <td>ID:</td>
        <td>$user[0]</td>
    </tr>
    <tr>
        <td>Логин:</td>
        <td>$user[1]</td>
    </tr>
    <tr>
        <td>Пароль:</td>
        <td>$user[2]</td>
    </tr>
    <tr>
        <td>Имя:</td>
        <td>$user[3]</td>
    </tr>
    <tr>
        <td>Фамилия:</td>
        <td>$user[4]</td>
    </tr>
    <tr>
        <td>Дата рождения:</td>
        <td>$user[5]</td>
    </tr>
    <tr>
        <td>Пол:</td>
        <td>$user[6]</td>
    </tr>
    <tr>
        <td>Уровень доступа:</td>
        <td>$user[7]</td>
    </tr>
    <tr>
        <td><a href="edit.php?id=$user[0]">Изменить</a></td>
        <td><a href="vendor/delete.php?id=$user[0]">Удалить</a></td>
    </tr>
</table>

<div class="" style="padding-top: 16px">
    <a style="margin-top: 32px; margin-bottom: 8px;padding: 0;" href="index.php">Список пользователей</a>
</div>

_END;

?>
</div>
</body>
</html>