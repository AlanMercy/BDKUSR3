<?php
include "../php/config.php";
include "../php/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_num_w = $_POST['pass_num_w'];
    $surname_w = $_POST['surname_w'];
    $name_w = $_POST['name_w'];
    $middlename_w = $_POST['middlename_w'];
    $post_w = $_POST['post_w'];
    $departament_w = $_POST['departament_w'];
    $phone_num_w = $_POST['phone_num_w'];

    $sql = 'INSERT INTO public.worker (pass_num_w, surname_w, name_w, middlename_w, post_w, departament_w, phone_num_w) 
            VALUES (:pass_num_w, :surname_w, :name_w, :middlename_w, :post_w, :departament_w, :phone_num_w)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'pass_num_w' => $pass_num_w,
        'surname_w' => $surname_w,
        'name_w' => $name_w,
        'middlename_w' => $middlename_w,
        'post_w' => $post_w,
        'departament_w' => $departament_w,
        'phone_num_w' => $phone_num_w
    ]);
    header("Location: ../Tables/workers.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Сотрудники</title>
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
        <h2>Сотрудники</h2>
        <form method="POST">
            <label for="pass_num_w">Номер паспорта:</label>
            <input type="text" id="pass_num_w" name="pass_num_w" required><br>
            <label for="surname_w">Фамилия:</label>
            <input type="text" id="surname_w" name="surname_w" required><br>
            <label for="name_w">Имя:</label>
            <input type="text" id="name_w" name="name_w" required><br>
            <label for="middlename_w">Отчество:</label>
            <input type="text" id="middlename_w" name="middlename_w"><br>
            <label for="post_w">Должность:</label>
            <input type="text" id="post_w" name="post_w" required><br>
            <label for="departament_w">Отдел:</label>
            <input type="text" id="departament_w" name="departament_w" required><br>
            <label for="phone_num_w">Номер телефона:</label>
            <input type="text" id="phone_num_w" name="phone_num_w" required><br>
            <input type="submit" value="Add Worker">
        </form>
    </div>
</body>
</html>
