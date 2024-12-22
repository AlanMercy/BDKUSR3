<?php
include "../php/config.php";
include "../php/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_cl = $_POST['pass_num_cl'];
    $surname_cl = $_POST['surname_cl'];
    $name_cl = $_POST['name_cl'];
    $middlename_cl = $_POST['middlename_cl'];
    $address_cl = $_POST['address_cl'];
    $phone_num_cl = $_POST['phone_num_cl'];

    $sql = 'INSERT INTO public.client (pass_num_cl, surname_cl, name_cl, middlename_cl, address_cl, phone_num_cl) 
            VALUES (:pass_num_cl, :surname_cl, :name_cl, :middlename_cl, :address_cl, :phone_num_cl)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_cl' => $pass_num_cl,
        'surname_cl' => $surname_cl,
        'name_cl' => $name_cl,
        'middlename_cl' => $middlename_cl,
        'address_cl' => $address_cl,
        'phone_num_cl' => $phone_num_cl
    ]);
    header("Location: ../Tables/clients.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить клиента</title>
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
    </style>
</head>
<body>
<div class="container">
        <h2>Добавить клиента</h2>
        <form method="POST">
            <label for="pass_num_cl">Паспорт клиента:</label>
            <input type="text" id="pass_num_cl" name="pass_num_cl" required><br>
            <label for="surname_cl">Фамилия:</label>
            <input type="text" id="surname_cl" name="surname_cl" required><br>
            <label for="name_cl">Имя:</label>
            <input type="text" id="name_cl" name="name_cl" required><br>
            <label for="middlename_cl">Фамилия:</label>
            <input type="text" id="middlename_cl" name="middlename_cl"><br>
            <label for="address_cl">Адрес:</label>
            <input type="text" id="address_cl" name="address_cl" required><br>
            <label for="phone_num_cl">Телефон:</label>
            <input type="text" id="phone_num_cl" name="phone_num_cl" required><br>
            <input type="submit" value="Add Client">
        </form>
    </div>
</body>
</html>
