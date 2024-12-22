<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        .nav {
            background-color: #333;
            overflow: hidden;
            position: relative; 
        }
        .nav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .nav form {
            float: left;
            padding: 10px 16px;
        }
        .nav select, .nav button, .nav input {
            margin-left: 10px;
            padding: 5px;
        }
        .nav .right {
            position: absolute;
            top: 0;
            right: 0;
        }
        .date-fields {
            display: none;
        }
    </style>
    <script>
        function toggleDateFields() {
            var reportType = document.getElementById('report_type').value;
            var dateFields = document.getElementById('date-fields');
            if (reportType === 'profitability') {
                dateFields.style.display = 'inline';
            } else {
                dateFields.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="nav">
        <a href="../tables/clients_ser.php">Клиенты</a>
        <a href="../tables/services_ser.php">Услуги</a>
        <a href="../tables/services_provided_ser.php">Предоставленные услуги</a>
        <a href="../index.php" class="right">Выход</a>
        <form method="post" action="../tables/reports.php">
            <label for="report_type">Выберите тип отчета:</label>
            <select name="report_type" id="report_type" onchange="toggleDateFields()">
                <option value="service_usage">Отчет по использованию услуг</option>
                <option value="service_type_usage">Отчет по типам услуг</option>
            </select>
            <button type="submit" name="generate_report">Сгенерировать отчет</button>
        </form>
    </div>
</body>
</html>
