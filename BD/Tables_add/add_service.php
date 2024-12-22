<?php
include "../php/config.php";
include "../php/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title_ser = $_POST['title_ser'];
    $type_ser = $_POST['type_ser'];

    $sql = 'INSERT INTO public.service (title_ser, type_ser) VALUES (:title_ser, :type_ser)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title_ser' => $title_ser,
        'type_ser' => $type_ser
    ]);
    header("Location: ../Tables/services.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить услугу</title>
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
        <h2>Добавить услугу</h2>
        <form method="POST">
            <label for="title_ser">Название:</label>
            <input type="text" id="title_ser" name="title_ser" required><br>
            <label for="type_ser">Тип:</label>
            <input type="text" id="type_ser" name="type_ser" required><br>
            <input type="submit" value="Add Service">
        </form>
    </div>
</body>
</html>
