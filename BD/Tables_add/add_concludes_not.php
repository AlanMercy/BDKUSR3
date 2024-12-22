<?php
include "../php/config.php";
include "../php/header_not.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number_c = $_POST['number_c'];
    $pass_num_cl = $_POST['pass_num_cl'];

    $sql = 'INSERT INTO public.concludes (number_c, pass_num_cl) VALUES (:number_c, :pass_num_cl)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'number_c' => $number_c,
        'pass_num_cl' => $pass_num_cl
    ]);
    header("Location: ../Tables/concludes_not.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить заключение</title>
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
        input[type="text"], input[type="number"] {
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
        <h2>Добавить заключение</h2>
        <form method="POST">
            <label for="number_c">Номер контракта:</label>
            <input type="number" id="number_c" name="number_c" required><br>
            <label for="pass_num_cl">Паспорт клиента:</label>
            <input type="number" id="pass_num_cl" name="pass_num_cl" required><br>
            <input type="submit" value="Add Record">
        </form>
    </div>
</body>
</html>
