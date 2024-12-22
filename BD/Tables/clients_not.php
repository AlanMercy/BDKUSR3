<?php
include "../php/config.php";
include "../php/header_not.php";
// Получаем всех клиентов
$sql = 'SELECT * FROM public.client';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .btn-container {
            display: flex;
            justify-content: space-around;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Клиенты</h1>
    <table>
        <thead>
            <tr>
                <th>Номер паспорта</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Адрес</th>
                <th>Телефон</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?php echo htmlspecialchars($client['pass_num_cl']); ?></td>
                    <td><?php echo htmlspecialchars($client['surname_cl']); ?></td>
                    <td><?php echo htmlspecialchars($client['name_cl']); ?></td>
                    <td><?php echo htmlspecialchars($client['middlename_cl']); ?></td>
                    <td><?php echo htmlspecialchars($client['address_cl']); ?></td>
                    <td><?php echo htmlspecialchars($client['phone_num_cl']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
