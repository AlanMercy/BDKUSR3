<?php
include "../php/config.php";
include "../php/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_w = $_POST['pass_num_w'];
    $id_pr = $_POST['id_pr'];
    $date_of_conclusion_c = $_POST['date_of_conclusion_c'];
    $type_of_transaction_c = $_POST['type_of_transaction_c'];
    $amount_c = $_POST['amount_c'];

    $sql = 'INSERT INTO public.contract (pass_num_w, id_pr, date_of_conclusion_c, type_of_transaction_c, amount_c) VALUES (:pass_num_w, :id_pr, :date_of_conclusion_c, :type_of_transaction_c, :amount_c)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_w' => $pass_num_w,
        'id_pr' => $id_pr,
        'date_of_conclusion_c' => $date_of_conclusion_c,
        'type_of_transaction_c' => $type_of_transaction_c,
        'amount_c' => $amount_c
    ]);
    header("Location: ../Tables/contracts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contract</title>
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
            border: 1px;
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
        <h2>Добавить договор</h2>
        <form method="POST">
            <label for="number_c">Номер договора:</label>
            <input type="text" id="number_c" name="number_c" required><br>
            <label for="pass_num_w">Нотариус:</label>
            <input type="text" id="pass_num_w" name="pass_num_w" required><br>
            <label for="id_pr">Номер предоставляемой услуги:</label>
            <input type="text" id="id_pr" name="id_pr" required><br>
            <label for="date_of_conclusion_c">Дата заключения:</label>
            <input type="date" id="date_of_conclusion_c" name="date_of_conclusion_c" required><br>
            <label for="type_of_transaction_c">Тип оплаты:</label>
            <input type="text" id="type_of_transaction_c" name="type_of_transaction_c" required><br>
            <label for="amount_c">Цена:</label>
            <input type="number" id="amount_c" name="amount_c" required><br>
        </form>
    </div>
</body>
</html>
