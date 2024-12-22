<?php
include "../php/config.php";
include "../php/header_acc.php";
// Получаем всех сотрудников
$sql = 'SELECT * FROM public.worker';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$workers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workers</title>
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
    <h1>Сотрудники</h1>
    <table>
        <thead>
            <tr>
                <th>Номер паспорта</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Должность</th>
                <th>Отдел</th>
                <th>Номер телефона</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workers as $worker): ?>
                <tr>
                    <td><?php echo htmlspecialchars($worker['pass_num_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['surname_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['name_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['middlename_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['post_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['departament_w']); ?></td>
                    <td><?php echo htmlspecialchars($worker['phone_num_w']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
