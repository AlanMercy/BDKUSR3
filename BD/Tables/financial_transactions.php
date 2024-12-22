<?php
include "../php/config.php";
include "../php/header.php";
// Получаем все сервисы
$sql = 'SELECT * FROM public.financial_transactions';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$fts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Финансовые операции</title>
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
    <h1>Финансовые операции</h1>
    <a href="../Tables_add/add_financial_transactions.php" class="btn">Добавить новую операцию</a>
    <table>
        <thead>
            <tr>
                <th>Номер операции</th>
                <th>Бухгалтер</th>
                <th>Тип операции</th>
                <th>Дата</th>
                <th>Название операции</th>
                <th>Стоимость</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fts as $ft): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ft['id_ft']); ?></td>
                    <td><?php echo htmlspecialchars($ft['pass_num_w']); ?></td>
                    <td><?php echo htmlspecialchars($ft['type_of_operation_fl']); ?></td>
                    <td><?php echo htmlspecialchars($ft['date_fl']); ?></td>
                    <td><?php echo htmlspecialchars($ft['title_transaction_fl']); ?></td>
                    <td><?php echo htmlspecialchars($ft['amount_fl']); ?></td>
                    <td class="btn-container">
                        <a href="../Tables_edit/edit_financial_transactions.php?id_ft=<?php echo urlencode($ft['id_ft']); ?>" class="btn">Edit</a>
                        <a href="../Tables_delete/delete_financial_transactions.php?id_ft=<?php echo urlencode($ft['id_ft']); ?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
