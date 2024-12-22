<?php
include "../php/config.php";
include "../php/header_acc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_w = $_POST['pass_num_w'];
    $type_of_operation_fl = $_POST['type_of_operation_fl'];
    $date_fl = $_POST['date_fl'];
    $title_transaction_fl = $_POST['title_transaction_fl'];
    $amount_fl = $_POST['amount_fl'];

    $sql = 'INSERT INTO public.financial_transactions (pass_num_w, type_of_operation_fl, date_fl, title_transaction_fl, amount_fl) VALUES (:pass_num_w, :type_of_operation_fl, :date_fl, :title_transaction_fl, :amount_fl)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_w' => $pass_num_w,
        'type_of_operation_fl' => $type_of_operation_fl,
        'date_fl' => $date_fl,
        'title_transaction_fl' => $title_transaction_fl,
        'amount_fl' => $amount_fl
    ]);
    header("Location: ../Tables/financial_transactions_acc.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить финансовую транзакцию</title>
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
        <h2>Добавить финансовую транзакцию</h2>
        <form method="POST">
            <label for="pass_num_w">Паспорт бухгалтера:</label>
            <input type="text" id="pass_num_w" name="pass_num_w" required><br>
            <label for="type_of_operation_fl">Тип операции:</label>
            <input type="text" id="type_of_operation_fl" name="type_of_operation_fl" required><br>
            <label for="date_fl">Дата:</label>
            <input type="date" id="date_fl" name="date_fl" required><br>
            <label for="title_transaction_fl">Название:</label>
            <input type="text" id="title_transaction_fl" name="title_transaction_fl" required><br>
            <label for="amount_fl">Стоимость:</label>
            <input type="number" id="amount_fl" name="amount_fl" required><br>
            <input type="submit" value="Add Transaction">
        </form>
    </div>
</body>
</html>
