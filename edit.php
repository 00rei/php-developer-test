<?php
require_once 'vendor/check_user.php';
require_once 'vendor/functions.php';

$title = 'Создание нового пользователя';

//If the "new" parameter was not passed,
// get information about the user being edited and add it to the html code
if (!isset($_GET['new'])){


    $id_user = sanitizeString($_GET['id']); //Clear string
    $id_user_link_return_to_full_view = '?id='.$id_user; // Generate a link to return to the "Full Information" page about the edited user

    // Create and execute a database query
    $sql = "select u.id, u.login, u.password, u.name, u.surname, u.date_of_birth, g.name, r.name, g.id, r.id
        from users u, genders g, roles r
        where u.id_genders = g.id and u.id_roles = r.id and u.id = $id_user";
    $results = queryMySQL($sql);
    $user = $results -> fetch_row();


    $login = $user[1];
    $password = $user[2];
    $user_name = $user[3];
    $surname = $user[4];
    $date = $user[5];
    $gender_id = $user[8];
    $role_id = $user[9];
    $title = "Редактирование – $user_name $surname";

    //Based on the received data, determine which values will be selected in the "select" objects
    $male = ''; $female = ''; $is_admin = ''; $is_user = '';
    $gender_id == 1 ? $male = 'selected' : $female = 'selected';
    $role_id == 1 ? $is_admin = 'selected' : $is_user = 'selected';
}
else {
    // If this is the creation of a new record,
    // then information about this will be transferred to save.php
    // through a hidden field in the form
    $id_user = 'new';
}

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

<p class="hello-admin">
    Добрый день, <?= $_SESSION['user'] ?>. <a href="vendor/logout.php">Выйти</a>
</p>

<h3 class="title">
    <?= "$title"?>
</h3>

<div class="content">
<form action="vendor/save.php" method="post">

    <?php

    echo <<<_END
<table class="last-text-right table-row-underline">
    <tr>
        <td>ID:</td>
        <td>$id_user<input type="hidden" name="id" value="$id_user"></td>
    </tr>
    <tr>
        <td>Логин:</td>
        <td><input type="text" name="login" value="$login" required></td>
    </tr>
    <tr>
        <td>Пароль:</td>
        <td><input type="text" name="password" value="$password" required></td>
    </tr>
    <tr>
        <td>Имя:</td>
        <td><input type="text" name="name" value="$user_name" required></td>
    </tr>
    <tr>
        <td>Фамилия:</td>
        <td><input type="text" name="surname" value="$surname" required></td>
    </tr>
    <tr>
        <td>Дата рождения:</td>
        <td><input type="date" name="date_of_birth" value="$date" style="width: 100%" required></td>
    </tr>
    <tr>
        <td>Пол:</td>
        <td>
            <select name="genders" style="width: 100%" required>
                <option value="1" $male>Мужской</option>
                <option value="2" $female>Женский</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Уровень доступа:</td>
        <td>
            <select name="roles" style="width: 100%" required>
                <option value="2" $is_user>Пользователь</option>
                <option value="1" $is_admin>Администратор</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><input type="submit" class="bth-page" value="Сохранить"></td>
        <td><a href="full_view.php$id_user_link_return_to_full_view">Отмена</a></td>
    </tr>
</table>

<div class="" style="padding-top: 16px">
    <a style="margin-top: 32px; margin-bottom: 8px;padding: 0;" href="index.php">Список пользователей</a>
</div>

_END;

    ?>

</form>
</div>
</body>
</html>