<?php
include "../php/config.php";
include "../php/header_ser.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_w = $_POST['pass_num_w'];
    $title_ser = $_POST['title_ser'];
    $pass_num_cl = $_POST['pass_num_cl'];
    $id_ft = $_POST['id_ft'];
    $amount_pr = $_POST['amount_pr'];
    $date_reg_pr = $_POST['date_reg_pr'];

    $sql = 'INSERT INTO public.services_provided (pass_num_w, title_ser, pass_num_cl, id_ft, amount_pr, date_reg_pr) VALUES (:pass_num_w, :title_ser, :pass_num_cl, :id_ft, :amount_pr, :date_reg_pr)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_w' => $pass_num_w,
        'title_ser' => $title_ser,
        'pass_num_cl' => $pass_num_cl,
        'id_ft' => $id_ft,
        'amount_pr' => $amount_pr,
        'date_reg_pr' => $date_reg_pr
    ]);
    header("Location: ../Tables/services_provided_ser.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Предоставить услугу</title>
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
    <h2>Предоставить услугу</h2>
        <form method="POST">
            <label for="pass_num_w">Паспорт регистратора:</label>
            <input type="text" id="pass_num_w" name="pass_num_w" required><br>
            <label for="title_ser">Название услуги:</label>
            <input type="text" id="title_ser" name="title_ser" required><br>
            <label for="pass_num_cl">Паспорт клиента:</label>
            <input type="text" id="pass_num_cl" name="pass_num_cl" required><br>
            <label for="amount_pr">Стоимость:</label>
            <input type="number" id="amount_pr" name="amount_pr" required><br>
            <label for="date_reg_pr">Дата:</label>
            <input type="date" id="date_reg_pr" name="date_reg_pr" required><br>
            <input type="submit" value="Add Service Provided">
        </form>
    </div>
</body>
</html>
