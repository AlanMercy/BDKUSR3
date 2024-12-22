<?php
include "../php/config.php";
include "../php/header_ser.php";
// Получаем все сервисы
$sql = 'SELECT * FROM public.service';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
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
    <h1>Услуги</h1>
    <a href="../Tables_add/add_service_ser.php" class="btn">Добавить услугу</a>
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Тип</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['title_ser']); ?></td>
                    <td><?php echo htmlspecialchars($service['type_ser']); ?></td>
                    <td class="btn-container">
                        <a href="../Tables_edit/edit_service_ser.php?title_ser=<?php echo urlencode($service['title_ser']); ?>" class="btn">Edit</a>
                        <a href="../Tables_delete/delete_service_ser.php?title_ser=<?php echo urlencode($service['title_ser']); ?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
