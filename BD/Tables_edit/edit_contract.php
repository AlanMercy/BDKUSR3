<?php
include "../php/config.php";
include "../php/header.php";

// Проверяем, передан ли номер контракта
if (!isset($_GET['number_c'])) {
    // Если номер контракта не передан, перенаправляем пользователя обратно на страницу контрактов
    header("Location: ../Tables/contracts.php");
    exit;
}

// Получаем номер контракта из запроса
$number_c = urldecode($_GET['number_c']);

// Получаем данные о контракте из базы данных
$sql = 'SELECT * FROM public.contract WHERE number_c = :number_c';
$stmt = $pdo->prepare($sql);
$stmt->execute(['number_c' => $number_c]);
$contract = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, были ли переданы данные из формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $pass_num_w = $_POST['pass_num_w'];
    $id_pr = $_POST['id_pr'];
    $date_of_conclusion_c = $_POST['date_of_conclusion_c'];
    $type_of_transaction_c = $_POST['type_of_transaction_c'];
    $amount_c = $_POST['amount_c'];

    // Обновляем данные контракта
    $sql = 'UPDATE public.contract SET pass_num_w = :pass_num_w, id_pr = :id_pr, date_of_conclusion_c = :date_of_conclusion_c, type_of_transaction_c = :type_of_transaction_c, amount_c = :amount_c WHERE number_c = :number_c';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_w' => $pass_num_w,
        'id_pr' => $id_pr,
        'date_of_conclusion_c' => $date_of_conclusion_c,
        'type_of_transaction_c' => $type_of_transaction_c,
        'amount_c' => $amount_c,
        'number_c' => $number_c
    ]);

    // Перенаправляем пользователя на страницу контрактов после обновления
    header("Location: ../Tables/contracts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contract</title>
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
        input[type="text"], input[type="date"], input[type="number"] {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Изменение договора</h2>
        <form method="POST">
            <label for="pass_num_w">Паспорт нотариуса:</label>
            <input type="text" id="pass_num_w" name="pass_num_w" value="<?php echo htmlspecialchars($contract['pass_num_w']); ?>" required><br>
            <label for="id_pr">id предоставления услуг:</label>
            <input type="text" id="id_pr" name="id_pr" value="<?php echo htmlspecialchars($contract['id_pr']); ?>" required><br>
            <label for="date_of_conclusion_c">Дата заключения:</label>
            <input type="date" id="date_of_conclusion_c" name="date_of_conclusion_c" value="<?php echo htmlspecialchars($contract['date_of_conclusion_c']); ?>" required><br>
            <label for="type_of_transaction_c">Тип транзакции:</label>
            <input type="text" id="type_of_transaction_c" name="type_of_transaction_c" value="<?php echo htmlspecialchars($contract['type_of_transaction_c']); ?>" required><br>
            <label for="amount_c">Стоимость:</label>
            <input type="number" id="amount_c" name="amount_c" value="<?php echo htmlspecialchars($contract['amount_c']); ?>" required><br>
            <input type="submit" value="Update Contract">
        </form>
    </div>
</body>
</html>
