<?php
include "../php/config.php";
include "../php/header_not.php";

// Получаем все записи из таблицы concludes
$sql = 'SELECT * FROM public.concludes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concludes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concludes</title>
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
    <h1>Заключения</h1>
    <a href="../Tables_add/add_concludes_not.php" class="btn">Добавить новую запись</a>
    <table>
        <thead>
            <tr>
                <th>Номер договора</th>
                <th>Паспорт клиента</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($concludes as $conclude): ?>
                <tr>
                    <td><?php echo htmlspecialchars($conclude['number_c']); ?></td>
                    <td><?php echo htmlspecialchars($conclude['pass_num_cl']); ?></td>
                    <td class="btn-container">
                        <a href="../Tables_edit/edit_concludes_not.php?number_c=<?php echo urlencode($conclude['number_c']); ?>&pass_num_cl=<?php echo urlencode($conclude['pass_num_cl']); ?>" class="btn">Edit</a>
                        <a href="../Tables_delete/delete_concludes_not.php?number_c=<?php echo urlencode($conclude['number_c']); ?>&pass_num_cl=<?php echo urlencode($conclude['pass_num_cl']); ?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
