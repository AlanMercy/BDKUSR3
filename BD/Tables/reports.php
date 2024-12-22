<?php
include '../php/config.php';

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
    } elseif($report_type == "profitability") {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $filename = "Отчет_о_рентабельности_с_" . $start_date . "_по_" . $end_date . ".xls";
        $query = "
            SELECT title_transaction_fl AS \"Название транзакции\", date_fl AS \"Дата\", type_of_operation_fl AS \"Тип транзакции\", amount_fl AS \"Стоимость\"
            FROM financial_transactions
            WHERE date_fl BETWEEN :start_date AND :end_date;
        ";
        $params = [':start_date' => $start_date, ':end_date' => $end_date];
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
            <option value="profitability">Отчет о рентабельности</option>
        </select>
        <div id="date-fields" class="hidden">
            <label for="start_date">Начальная дата:</label>
            <input type="date" id="start_date" name="start_date">
            <label for="end_date">Конечная дата:</label>
            <input type="date" id="end_date" name="end_date">
        </div>
        <button type="submit" name="generate_report">Сгенерировать отчет</button>
    </form>
</body>
</html>
<script>
    function toggleDateFields() {
        const reportType = document.getElementById('report_type').value;
        const dateFields = document.getElementById('date-fields');
        if (reportType === 'profitability') {
            dateFields.classList.remove('hidden');
        } else {
            dateFields.classList.add('hidden');
        }
    }
</script>
