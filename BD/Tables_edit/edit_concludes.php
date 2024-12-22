<?php
include "../php/config.php";
include "../php/header.php";

// Проверяем, переданы ли номера контракта и клиента
if (!isset($_GET['number_c']) || !isset($_GET['pass_num_cl'])) {
    header("Location: ../Tables/concludes.php");
    exit;
}

$number_c = urldecode($_GET['number_c']);
$pass_num_cl = urldecode($_GET['pass_num_cl']);

// Получаем данные о записи из таблицы concludes
$sql = 'SELECT * FROM public.concludes WHERE number_c = :number_c AND pass_num_cl = :pass_num_cl';
$stmt = $pdo->prepare($sql);
$stmt->execute(['number_c' => $number_c, 'pass_num_cl' => $pass_num_cl]);
$conclude = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_number_c = $_POST['number_c'];
    $new_pass_num_cl = $_POST['pass_num_cl'];

    // Обновляем данные записи
    $sql = 'UPDATE public.concludes SET number_c = :new_number_c, pass_num_cl = :new_pass_num_cl WHERE number_c = :number_c AND pass_num_cl = :pass_num_cl';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'new_number_c' => $new_number_c,
        'new_pass_num_cl' => $new_pass_num_cl,
        'number_c' => $number_c,
        'pass_num_cl' => $pass_num_cl
    ]);

    header("Location: ../Tables/concludes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Concludes</title>
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
    <h2>Изменение заключений</h2>
        <form method="POST">
            <label for="number_c">Номер контракта:</label>
            <input type="number" id="number_c" name="number_c" value="<?php echo htmlspecialchars($conclude['number_c']); ?>" required><br>
            <label for="pass_num_cl">Паспорт клиента:</label>
            <input type="number" id="pass_num_cl" name="pass_num_cl" value="<?php echo htmlspecialchars($conclude['pass_num_cl']); ?>" required><br>
            <input type="submit" value="Update Record">
        </form>
    </div>
</body>
</html>
