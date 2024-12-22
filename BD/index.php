<?php
session_start();
require 'php/config.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_w = $_POST['pass_num_w'];
    $password = $_POST['password'];

    // Проверка учетных данных
    $query = "SELECT pass_num_w, password, role FROM public.worker WHERE pass_num_w = :pass_num_w AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['pass_num_w' => $pass_num_w, 'password' => $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user'] = [
            'pass_num_w' => $user['pass_num_w'],
            'role' => $user['role']
        ];
        header("Location: php/dashboard.php");
        exit;
    } else {
        $error = "Неверный номер паспорта или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h2>Вход</h2>
    <form method="post">
        <label for="pass_num_w">Номер паспорта:</label>
        <input type="text" id="pass_num_w" name="pass_num_w" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Войти</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
