<?php
include 'config.php';

if(isset($_POST['generate_report'])) {
    $report_type = $_POST['report_type'];
    $filename = "";
    $query = "";
    $params = [];
    $columns = [];

    if($report_type == "service_usage") {
        $filename = "Отчет_по_использованию_услуг.xls";
        $query = "
            SELECT s.title_ser AS \"Название услуги\", s.type_ser AS \"Тип услуги\", COUNT(sp.id_pr) AS \"Количество использований\"
            FROM services_provided sp
            JOIN service s ON sp.title_ser = s.title_ser
            GROUP BY s.title_ser, s.type_ser
            HAVING COUNT(sp.id_pr) > 0
            ORDER BY \"Количество использований\" DESC;
        ";
    } elseif($report_type == "service_type_usage") {
        $filename = "Отчет_по_типам_услуг.xls";
        $query = "
            SELECT s.type_ser AS \"Тип услуги\", COUNT(sp.id_pr) AS \"Количество использований\"
            FROM services_provided sp
            JOIN service s ON sp.title_ser = s.title_ser
            GROUP BY s.type_ser
            HAVING COUNT(sp.id_pr) > 0
            ORDER BY \"Количество использований\" DESC;
        ";
    }

    if ($query != "") {
        $stmt = $pdo->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($report_type == "profitability") {
            $total_income = 0;
            $total_expense = 0;

            foreach ($data as $row) {
                if ($row['Тип транзакции'] == 'Доход') {
                    $total_income += $row['Стоимость'];
                } elseif ($row['Тип транзакции'] == 'Расход') {
                    $total_expense += $row['Стоимость'];
                }
            }

            $profitability = $total_income - $total_expense;

            // Вывод данных в Excel
            if ($data) {
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Cache-Control: max-age=0");

                $output = fopen("php://output", "w");

                // Запись заголовков
                $header_written = false;
                foreach($data as $row) {
                    if(!$header_written) {
                        fputcsv($output, array_keys($row), "\t");
                        $header_written = true;
                    }
                    fputcsv($output, $row, "\t");
                }

                // Запись итогов
                fputcsv($output, [], "\t"); // Пустая строка для разделения
                fputcsv($output, ["", "", "Итоговый доход:", $total_income], "\t");
                fputcsv($output, ["", "", "Итоговый расход:", $total_expense], "\t");
                fputcsv($output, ["", "", "Рентабельность:", $profitability], "\t");

                fclose($output);
                exit;
            } else {
                echo "Ошибка при генерации отчета.";
            }
        } else {
            // Вывод данных в Excel для других отчетов
            if ($data) {
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Cache-Control: max-age=0");

                $output = fopen("php://output", "w");

                // Запись заголовков
                $header_written = false;
                foreach($data as $row) {
                    if(!$header_written) {
                        fputcsv($output, array_keys($row), "\t");
                        $header_written = true;
                    }
                    fputcsv($output, $row, "\t");
                }

                fclose($output);
                exit;
            } else {
                echo "Ошибка при генерации отчета.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчеты</title>
</head>
<body>
    <h1>Генерация отчетов</h1>
    <form method="post" action="reports.php">
        <label for="report_type">Выберите тип отчета:</label>
        <select name="report_type" id="report_type" onchange="toggleDateFields()">
            <option value="service_usage">Отчет по использованию услуг</option>
            <option value="service_type_usage">Отчет по типам услуг</option>
        </select>
        <button type="submit" name="generate_report">Сгенерировать отчет</button>
    </form>
</body>
</html>
<script>
    function toggleDateFields() {
        const reportType = document.getElementById('report_type').value;
        const dateFields = document.getElementById('date-fields');
    }
</script>
