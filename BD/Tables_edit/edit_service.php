<?php
include "../php/config.php";
include "../php/header.php";

// Проверяем, передано ли название сервиса
if (!isset($_GET['title_ser'])) {
    // Если название сервиса не передано, перенаправляем пользователя обратно на страницу сервисов
    header("Location: ../Tables/services.php");
    exit;
}

// Получаем название сервиса из запроса
$title_ser = urldecode($_GET['title_ser']);

// Получаем данные о сервисе из базы данных
$sql = 'SELECT * FROM public.service WHERE title_ser = :title_ser';
$stmt = $pdo->prepare($sql);
$stmt->execute(['title_ser' => $title_ser]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, были ли переданы данные из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $new_title_ser = $_POST['new_title_ser'];
    $type_ser = $_POST['type_ser'];

    // Проверяем, существует ли сервис с новым названием, только если оно изменилось
    if ($new_title_ser != $title_ser) {
        $sql = 'SELECT COUNT(*) FROM public.service WHERE title_ser = :new_title_ser';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['new_title_ser' => $new_title_ser]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Если сервис с новым названием уже существует, выводим сообщение об ошибке
            $error = "Service with title $new_title_ser already exists.";
        }
    }

    // Если ошибок нет, обновляем данные сервиса
    if (!isset($error)) {
        $sql = 'UPDATE public.service SET title_ser = :new_title_ser, type_ser = :type_ser WHERE title_ser = :title_ser';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'new_title_ser' => $new_title_ser,
            'type_ser' => $type_ser,
            'title_ser' => $title_ser
        ]);

        // Перенаправляем пользователя на страницу сервисов после обновления
        header("Location: ../Tables/services.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
        }
        form {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 3px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Изменение услуги</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="new_title_ser">Название:</label>
            <input type="text" id="new_title_ser" name="new_title_ser" value="<?php echo htmlspecialchars($service['title_ser']); ?>" required><br>
            <label for="type_ser">Тип:</label>
            <input type="text" id="type_ser" name="type_ser" value="<?php echo htmlspecialchars($service['type_ser']); ?>" required><br>
            <input type="submit" value="Update Service">
        </form>
    </div>
</body>
</html>
