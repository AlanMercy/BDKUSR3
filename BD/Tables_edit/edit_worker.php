<?php
include "../php/config.php";
include "../php/header.php";

// Проверяем, передан ли идентификатор сотрудника
if (!isset($_GET['pass_num_w'])) {
    // Если идентификатор сотрудника не передан, перенаправляем пользователя обратно на страницу сотрудников
    header("Location: ../Tables/workers.php");
    exit;
}

// Получаем идентификатор сотрудника из запроса
$pass_num_w = $_GET['pass_num_w'];

// Получаем данные о сотруднике из базы данных
$sql = 'SELECT * FROM public.worker WHERE pass_num_w = :pass_num_w';
$stmt = $pdo->prepare($sql);
$stmt->execute(['pass_num_w' => $pass_num_w]);
$worker = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, были ли переданы данные из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $new_pass_num_w = $_POST['new_pass_num_w'];
    $surname_w = $_POST['surname_w'];
    $name_w = $_POST['name_w'];
    $middlename_w = $_POST['middlename_w'];
    $post_w = $_POST['post_w'];
    $departament_w = $_POST['departament_w'];
    $phone_num_w = $_POST['phone_num_w'];

    // Проверяем, существует ли сотрудник с новыми паспортными данными, только если они изменились
    if ($new_pass_num_w != $pass_num_w) {
        $sql = 'SELECT COUNT(*) FROM public.worker WHERE pass_num_w = :new_pass_num_w';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['new_pass_num_w' => $new_pass_num_w]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Если сотрудник с новыми паспортными данными уже существует, выводим сообщение об ошибке
            $error = "Worker with passport number $new_pass_num_w already exists.";
        }
    }

    // Если ошибок нет, обновляем данные сотрудника
    if (!isset($error)) {
        $sql = 'UPDATE public.worker SET pass_num_w = :new_pass_num_w, surname_w = :surname_w, name_w = :name_w, middlename_w = :middlename_w, post_w = :post_w, departament_w = :departament_w, phone_num_w = :phone_num_w WHERE pass_num_w = :pass_num_w';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'new_pass_num_w' => $new_pass_num_w,
            'surname_w' => $surname_w,
            'name_w' => $name_w,
            'middlename_w' => $middlename_w,
            'post_w' => $post_w,
            'departament_w' => $departament_w,
            'phone_num_w' => $phone_num_w,
            'pass_num_w' => $pass_num_w
        ]);

        // Перенаправляем пользователя на страницу сотрудников после обновления
        header("Location: ../Tables/workers.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Worker</title>
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
        <h2>Изменение сотрудника</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="new_pass_num_w">Паспорт сотрудника:</label>
            <input type="text" id="new_pass_num_w" name="new_pass_num_w" value="<?php echo htmlspecialchars($worker['pass_num_w']); ?>" required><br>
            <label for="surname_w">Фамилия:</label>
            <input type="text" id="surname_w" name="surname_w" value="<?php echo htmlspecialchars($worker['surname_w']); ?>" required><br>
            <label for="name_w">Имя:</label>
            <input type="text" id="name_w" name="name_w" value="<?php echo htmlspecialchars($worker['name_w']); ?>" required><br>
            <label for="middlename_w">Отчество:</label>
            <input type="text" id="middlename_w" name="middlename_w" value="<?php echo htmlspecialchars($worker['middlename_w']); ?>"><br>
            <label for="post_w">Должность:</label>
            <input type="text" id="post_w" name="post_w" value="<?php echo htmlspecialchars($worker['post_w']); ?>" required><br>
            <label for="departament_w">Отдел:</label>
            <input type="text" id="departament_w" name="departament_w" value="<?php echo htmlspecialchars($worker['departament_w']); ?>" required><br>
            <label for="phone_num_w">Номер телефона:</label>
            <input type="text" id="phone_num_w" name="phone_num_w" value="<?php echo htmlspecialchars($worker['phone_num_w']); ?>" required><br>
            <input type="submit" value="Update Worker">
        </form>
    </div>
</body>
</html>
