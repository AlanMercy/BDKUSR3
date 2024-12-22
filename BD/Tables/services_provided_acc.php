<?php
include "../php/config.php";
include "../php/header_acc.php";

// Получаем все предоставленные услуги
$sql = 'SELECT * FROM public.services_provided';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$services_provided = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services Provided</title>
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
    <h1>Предоставляемые услуги</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Паспорт регистратора</th>
                <th>Название услуги</th>
                <th>Паспорт клиента</th>
                <th>Стоимость</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services_provided as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['id_pr']); ?></td>
                    <td><?php echo htmlspecialchars($service['pass_num_w']); ?></td>
                    <td><?php echo htmlspecialchars($service['title_ser']); ?></td>
                    <td><?php echo htmlspecialchars($service['pass_num_cl']); ?></td>
                    <td><?php echo htmlspecialchars($service['amount_pr']); ?></td>
                    <td><?php echo htmlspecialchars($service['date_reg_pr']); ?></td>
                    <td class="btn-container">
                        <a href="../Tables_edit/edit_service_provided_acc.php?id_pr=<?php echo urlencode($service['id_pr']); ?>" class="btn">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
