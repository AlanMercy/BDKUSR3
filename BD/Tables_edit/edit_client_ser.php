<?php
include "../php/config.php";
include "../php/header_ser.php";

// Проверяем, передан ли идентификатор клиента
if (!isset($_GET['pass_num_cl'])) {
    // Если идентификатор клиента не передан, перенаправляем пользователя обратно на страницу клиентов
    header("Location: ../Tables/clients_ser.php");
    exit;
}

// Получаем идентификатор клиента из запроса
$pass_num_cl = $_GET['pass_num_cl'];

// Получаем данные о клиенте из базы данных
$sql = 'SELECT * FROM public.client WHERE pass_num_cl = :pass_num_cl';
$stmt = $pdo->prepare($sql);
$stmt->execute(['pass_num_cl' => $pass_num_cl]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, были ли переданы данные из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $new_pass_num_cl = $_POST['new_pass_num_cl'];
    $surname_cl = $_POST['surname_cl'];
    $name_cl = $_POST['name_cl'];
    $middlename_cl = $_POST['middlename_cl'];
    $address_cl = $_POST['address_cl'];
    $phone_num_cl = $_POST['phone_num_cl'];

    // Проверяем, существует ли клиент с новыми паспортными данными, только если они изменились
    if ($new_pass_num_cl != $pass_num_cl) {
        $sql = 'SELECT COUNT(*) FROM public.client WHERE pass_num_cl = :new_pass_num_cl';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['new_pass_num_cl' => $new_pass_num_cl]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Если клиент с новыми паспортными данными уже существует, выводим сообщение об ошибке
            $error = "Client with passport number $new_pass_num_cl already exists.";
        }
    }

    // Если ошибок нет, обновляем данные клиента
    if (!isset($error)) {
        $sql = 'UPDATE public.client SET pass_num_cl = :new_pass_num_cl, surname_cl = :surname_cl, name_cl = :name_cl, middlename_cl = :middlename_cl, address_cl = :address_cl, phone_num_cl = :phone_num_cl WHERE pass_num_cl = :pass_num_cl';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'new_pass_num_cl' => $new_pass_num_cl,
            'surname_cl' => $surname_cl,
            'name_cl' => $name_cl,
            'middlename_cl' => $middlename_cl,
            'address_cl' => $address_cl,
            'phone_num_cl' => $phone_num_cl,
            'pass_num_cl' => $pass_num_cl
        ]);

        // Перенаправляем пользователя на страницу клиентов после обновления
        header("Location: ../Tables/clients_ser.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Client</title>
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
        <h2>Изменение данных клиента</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="new_pass_num_cl">Паспортные данные:</label>
            <input type="text" id="new_pass_num_cl" name="new_pass_num_cl" value="<?php echo htmlspecialchars($client['pass_num_cl']); ?>" required><br>
            <label for="surname_cl">Фамилия:</label>
            <input type="text" id="surname_cl" name="surname_cl" value="<?php echo htmlspecialchars($client['surname_cl']); ?>" required><br>
            <label for="name_cl">Имя:</label>
            <input type="text" id="name_cl" name="name_cl" value="<?php echo htmlspecialchars($client['name_cl']); ?>" required><br>
            <label for="middlename_cl">Отчество:</label>
            <input type="text" id="middlename_cl" name="middlename_cl" value="<?php echo htmlspecialchars($client['middlename_cl']); ?>"><br>
            <label for="address_cl">Адрес:</label>
            <input type="text" id="address_cl" name="address_cl" value="<?php echo htmlspecialchars($client['address_cl']); ?>" required><br>
            <label for="phone_num_cl">Телефон:</label>
            <input type="text" id="phone_num_cl" name="phone_num_cl" value="<?php echo htmlspecialchars($client['phone_num_cl']); ?>" required><br>
            <input type="submit" value="Update Client">
        </form>
    </div>
</body>
</html>
