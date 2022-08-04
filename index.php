<?php
require_once 'vendor/check_user.php';
require_once 'vendor/functions.php';

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Список пользователей</title>
</head>
<body>

<p class="hello-admin">
    Добрый день, <?= $_SESSION['user'] ?>. <a href="vendor/logout.php">Выйти</a>
</p>

<h3 class="title">
    Список пользователей
</h3>

<?php
$sql = "select COUNT(*) from users";
$results = queryMySQL($sql);
$count_pages = ceil($results -> fetch_row()[0] / 10);


$order = $_GET['order'] ?? 'asc'; // the sort order
$order_by = $_GET['order_by'] ?? 'id'; //sorting by this field
$start_of_limit=isset($_GET['page']) ? ($_GET['page'] - 1) * 10 : 0; // determine the number of pages

// Clear strings
$order = sanitizeString($order);
$order_by = sanitizeString($order_by);
$start_of_limit=sanitizeString($start_of_limit);

// Create and execute a database query
$sql = "SELECT users.id, users.login, users.name, users.surname, r.name 
        FROM users left outer join roles r on r.id = users.id_roles 
        ORDER BY users.$order_by $order LIMIT $start_of_limit, 10";
$results = queryMySQL($sql);
$results = mysqli_fetch_all($results);


// Based on the received data, determine which values will be selected in the "select" objects
$asc = ''; $desc = ''; $id = ''; $login = ''; $name = ''; $surname = '';
if (isset($_GET['order']) && $_GET['order'] == 'asc') $asc = 'selected';
if (isset($_GET['order']) && $_GET['order'] == 'desc') $desc = 'selected';
if (isset($_GET['order_by']) && $_GET['order_by'] == 'id') $id = 'selected';
if (isset($_GET['order_by']) && $_GET['order_by'] == 'login') $login = 'selected';
if (isset($_GET['order_by']) && $_GET['order_by'] == 'name') $name = 'selected';
if (isset($_GET['order_by']) && $_GET['order_by'] == 'surname') $surname = 'selected';

// Sorting form
echo <<<_END
<div class="content" style="padding-bottom: 32px">
    <form action="/?hehhh=grte">
        <table>
            <tr>
                <td>Сортировка:</td>
                <td>
                    <label>
                        <select name="order" >
                            <option value="asc" $asc>По возрастанию</option>
                            <option value="desc" $desc>По убыванию</option>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <select name="order_by">
                            <option value="id" $id>id</option>
                            <option value="login" $login>Логин</option>
                            <option value="name" $name>Имя</option>
                            <option value="surname" $surname>Фамилия</option>
                        </select>
                    </label>
                </td>
                <td><button type="submit">Применить</button></td>
            </tr>
        </table>
    </form>
        <table class="table-row-underline">
            <tbody>
            <tr>
                <th>id</th>
                <th>Логин</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Уровень доступа</th>
                <th colspan="2">Действия</th>
            </tr>
_END;

// Display strings with information about users
foreach ($results as $result){
echo <<<_END
            <tr>
                <td>$result[0]</td>
                <td>$result[1]</td>
                <td>$result[2]</td>
                <td>$result[3]</td>
                <td>$result[4]</td>
                <td><a href="full_view.php?id=$result[0]">Просмотр</a></td>
                <td><a href="vendor/delete.php?id=$result[0]">Удалить</a></td>
            </tr>
_END;

            }

echo <<<_END
            </tbody>
        </table>
    
        <div class="text-center my-16">
_END;


// Pagination
            for ($i = 1; $i <= $count_pages; $i++){
                $no_active = '';

                if ($_GET['page'] == $i)
                    $no_active = 'no-active';
                elseif (!isset($_GET['page']) && $i == 1)
                    $no_active = 'no-active';

                $url = str_replace('&page='.$_GET['page'], '', $_SERVER['QUERY_STRING']);
                echo '<a class="mx-16 '.$no_active.'" href="/index.php?'.$url.'&page='.$i.'">Стр. '.$i.'</a>';
            }


            echo <<<_END
        </div>
    <a style="margin-top: 16px; margin-bottom: 16px;padding: 0;" href="edit.php?new=new">Создать новую запись</a>

</div>
</body>
</html>
_END;

