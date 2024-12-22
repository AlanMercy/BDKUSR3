<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$role = $_SESSION['user']['role'];

// Определение заголовка на основе роли пользователя
switch ($role) {
    case 1:
        include 'header_acc.php';
        break;
    case 2:
        include 'header_not.php';
        break;
    case 3:
        include 'header_ser.php';
        break;
    case 4:
        include 'header.php';
        break;
    default:
        echo "У вас нет доступа к этому сайту.";
        exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Добро пожаловать!</h1>
    <p>Вы вошли как пользователь с ролью: <?php echo $role; ?></p>
</body>
</html>
