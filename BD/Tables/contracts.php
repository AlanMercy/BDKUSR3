<?php
include "../php/config.php";
include "../php/header.php";

if (isset($_GET['number_c'])) {
    $number_c = intval($_GET['number_c']);

    // Call the stored procedure to link client to contract
    $sql = 'CALL link_client_to_contract(:number_c)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['number_c' => $number_c]);

    header("Location: ../Tables/contracts.php");
    exit;
}

// Получаем все записи из таблицы contract
$sql = 'SELECT * FROM public.contract';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$contracts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contracts</title>
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
<h1>Договоры</h1>
    <a href="../Tables_add/add_contract.php" class="btn">Добавить новый договор</a>
    <table>
        <thead>
            <tr>
                <th>Номер договора</th>
                <th>Паспорт нотариуса</th>
                <th>id предоставляемой услуги</th>
                <th>Дата заключения</th>
                <th>Тип транзакции</th>
                <th>Стоимотсть</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contracts as $contract): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contract['number_c']); ?></td>
                    <td><?php echo htmlspecialchars($contract['pass_num_w']); ?></td>
                    <td><?php echo htmlspecialchars($contract['id_pr']); ?></td>
                    <td><?php echo htmlspecialchars($contract['date_of_conclusion_c']); ?></td>
                    <td><?php echo htmlspecialchars($contract['type_of_transaction_c']); ?></td>
                    <td><?php echo htmlspecialchars($contract['amount_c']); ?></td>
                    <td class="btn-container">
                        <a href="../Tables_edit/edit_contract.php?number_c=<?php echo urlencode($contract['number_c']); ?>" class="btn">Edit</a>
                        <a href="../Tables_delete/delete_contract.php?number_c=<?php echo urlencode($contract['number_c']); ?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
                        <a href="../Tables/contracts.php?number_c=<?php echo urlencode($contract['number_c']); ?>" class="btn">Link Client</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
